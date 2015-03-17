/*
 * Red agent
 * http://www.red-agent.com/wallogram
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI({
    useBrowserConsole: true
}).use("base-build", "widget", "scrollview", "button", "timers", "json-parse", // Dependencies
    "transition", "io-base", "history", "event-key", "event-mouseenter",
    "gallery-yui-slideshow", "node-screen",
    "redagent-display", "redagent-chat", "redagent-pusher",
    "redagent-controller", function(Y) {
        var bd = Y.one("body"),
            controller = new Y.RedAgent.Controller(), //                        // Pages controller (history, loading, etc.)
            pusher = new Y.RedAgent.Pusher(), //                                // Websocket facade
            display = new Y.RedAgent.Display().render(".cr"), //                // Render Crafty drawing area (canvas)
            chat = new Y.RedAgent.Chat({
                srcNode: ".scrollview-container div"
            }).render();                                                        // Render chat              

        chat.on("chatEnter", function(e) {                                      // When chat input is entered
            display.say("You", e.msg);                                          // Show msg in the canvas

            if (pusher.channel && pusher.channel.members.count > 1) {           // and there are other players in the chat,
                pusher.channel.trigger("client-chat", {
                    name: "Anonymous",
                    msg: e.msg,
                    id: pusher.channel.members.me.id
                });                                                             // send websocket event
            } else {                                                            // Otherwise, player is alone
                Y.io("programo/chatbot/conversation_start.php", {//             // send io request to chatter bot
                    method: "POST",
                    data: "say=" + encodeURIComponent(e.msg)
                        + "&convo_id=" + convoId
                        + "&bot_id=1&format=json",
                    on: {
                        success: function(tId, e) {
                            var response = Y.JSON.parse(e.responseText);
                            chat.say("Red agent", response.botsay);
                            display.say("Red agent", response.botsay);
                        }
                    }
                });
            }
        });

        if (pusher.channel) {                                                   // If channel is detected (for offline debug)
            var sendJump = function() {
                pusher.channel.trigger("client-jump", {//                       // Send him a message to tell our actual position
                    id: pusher.channel.members.me.id,
                    x: display.player.x,
                    y: display.player.y,
                    name: display.player.label()
                });
            }
            pusher.channel.bind("client-chat", function(e) {                    // When a chat message is received through websocket
                controller.playNotification();
                chat.say(e.name, e.msg);                                        // display it in the chat
                display.say(e.id, e.msg);
            });

            pusher.channel.bind('pusher:subscription_succeeded', function(members) {// On connection to the channel,
                Y.log("Presence channel subscription_succeeded, count: " + members.count);
                display.getPlayer("You").label("Anonymous " + members.count + " <em>(me)</em>");
                members.each(function(m) {                                      // display all members that are already on the channel
                    if (m.id !== members.myID) {
                        display.addPlayer(m);
                    }
                });
                sendJump();
            });

            pusher.channel.bind('pusher:member_added', function(member) {       // When somebody connect,
                Y.log("Member added, count: ", pusher.channel.members.count);
                display.addPlayer(member);                                      // display the newcomer
                controller.playNotification();
                sendJump();                                                     // and send pusher event to update newcomer about current postion
            });

            pusher.channel.bind('pusher:member_removed', function(member) {     // When somebody disconnect
                Y.log("Member removed, count ", pusher.channel.members.count);
                display.getPlayer(member.id).destroy();
            });

            pusher.channel.bind('client-move', function(e) {                    // When somebody else moves,
                Y.log("Client-move", e);
                display.getPlayer(e.id).moveTo(e.x, e.y).initialized = true;    // update it's sprite
            });

            pusher.channel.bind('client-jump', function(e) {                    // Postion update event, so players are at the right position at the beginning
                Y.log("Client-jump", e);
                var entity = display.getPlayer(e.id);
                if (!entity.initialized) {
                    entity.attr({x: e.x, y: e.y}).initialized = true;
                    entity.visible = true;
                    entity.label(e.name);
                }
            });

            pusher.channel.bind("client-rename", function(e) {                  // When a player is renamed
                var player = display.getPlayer(e.id);
                chat.notify(player.label() + " has changed his name to " + e.name + ".");// display it in the chat
                player.label(e.name);
            });
        }

        bd.removeClass("redagent-loading");
        bd.delegate("click", controller.closePage, ".redagent-closebutton", controller);// Close button click
        bd.delegate("click", controller.showPage, "a.redagent-nav-projects", controller, "Projects");// Nav click
        bd.delegate("click", controller.showPage, "a.redagent-nav-contact", controller, "Contact");
        bd.delegate("click", controller.showPage, "a.redagent-nav-blog", controller, "Blog");// Nav click

        var doUpdate = function(pageName) {
            var target, found = false;
            Y.all(".redagent-page-" + pageName + " .cf > *[id]").each(function(n) {
                if (found) {
                } else if (n.get("id") && n.get("docScrollY") + 60 < n.get("region").top) {
                    found = true;
                } else {
                    target = n.get("id");
                }
            });
            if (target && Y.one("a[href='#" + target + "']")) {
                Y.all(".redagent-menu-" + pageName + " .redagent-selected").removeClass("redagent-selected");
                Y.one("a[href='#" + target + "']").addClass("redagent-selected");
            }
        },
            updateScroll = function() {
                doUpdate("projects");
                doUpdate("blog");
            };
        window.onscroll = updateScroll;
        bd.delegate("click", updateScroll, "a.redagent-nav-projects, a.redagent-nav-blog");
        updateScroll();

        if (currentPage !== "Red agent") {
            Crafty.pause();
        }

        var firstmsg = "Welcome on Francois-Xavier's home page.",
            secmsg = "It appears there's only the two of us on this page at the moment. Feel free to look around and ask me if you have any question.";

        Y.later(2000, this, function() {
            chat.say("Red agent", firstmsg);
            display.say("Red agent", firstmsg);
        });
        Y.later(4000, this, function() {
            chat.say("Red agent", secmsg);
            display.say("Red agent", secmsg);
        });

        $.localScroll({
            target: 'body', // could be a selector or a jQuery object too.
            duration: 1000,
            hash: true
        });
    });
