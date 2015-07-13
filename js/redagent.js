/*
 * Red agent
 * http://www.red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI({
    useBrowserConsole: true
}).use("base-build", "widget", "timers", "json-parse", "history", "transition", // Dependencies
    "io-base", "event-key", "event-valuechange", "event-resize", "dom-screen",
    "redagent-display", "redagent-chat", "redagent-pusher", "redagent-controller", function(Y) {
        var bd = Y.one("body"),
            controller = new Y.RedAgent.Controller(), //                        // Pages controller (history, loading, etc.)
            pusher = new Y.RedAgent.Pusher(), //                                // Websocket facade
            display = new Y.RedAgent.Display().render(".cr"), //                // Render Crafty drawing area (canvas)
            chat = new Y.RedAgent.Chat().render(".scrollview-container");       // Render chat

        chat.on("chatEnter", function(e) {                                      // When chat input is entered
            Crafty('PlayablePC').say(e.msg);                                    // Show msg in the canvas

            if (pusher.channel && pusher.channel.members.count > 1) {           // and there are other players in the chat,
                pusher.trigger("chat", {
                    msg: e.msg
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
                            display.say("bot", response.botsay);
                        }
                    }
                });
            }
        });

        if (pusher.channel) {                                                   // If channel is detected (for offline debug)
            var sendJump = function() {
                pusher.trigger("jump", {//                                      // Send him a message to tell our actual position
                    x: display.player.x,
                    y: display.player.y,
                    name: display.player.label()
                });
            };

            pusher.channel.bind('pusher:subscription_succeeded', function(members) {// On connection to the channel,
                Y.log("Presence channel subscription_succeeded, count: " + members.count);
                var label = $.cookie("chatname") || "Anonymous " + members.count;
                Crafty('PlayablePC').label(label);
                members.each(function(m) {                                      // display all members that are already on the channel
                    if (m.id !== members.myID) {
                        display.addPlayer(m);
                    }
                });
                sendJump();
            });

            pusher.channel.bind('pusher:member_added', function(member) {       // When somebody connect,
                Y.log("Member added, count: ", pusher.channel.members.count);
                var player = display.addPlayer(member);                         // display the newcomer
                player.isNewPlayer = true;
                controller.playNotification();
                sendJump();                                                     // and send pusher event to update newcomer about current postion
            });

            pusher.channel.bind('pusher:member_removed', function(member) {     // When somebody disconnect
                Y.log("Member removed, count ", pusher.channel.members.count);
                var player = display.getPlayer(member.id);
                chat.notify(player.label() + " has left.");
                player.destroy();
            });

            pusher.channel.bind('client-move', function(e) {                    // When somebody else moves,
                Y.log("Client-move", e);
                display.getPlayer(e.id).moveTo(e.x, e.y).initialized = true;    // update it's sprite
            });

            pusher.channel.bind('client-jump', function(e) {                    // Postion update event, so players are at the right position at the beginning
                Y.log("Client-jump", e);
                var player = display.getPlayer(e.id);
                if (!player.initialized) {
                    player.attr({x: e.x, y: e.y})
                        .label(e.name)
                        .initialized = true;
                    player.visible = true;
                    player.isNewPlayer && chat.notify(e.name + " has joined.");
                }
            });

            pusher.channel.bind("client-chat", function(e) {                    // When a chat message is received through websocket
                var player = display.getPlayer(e.id);
                chat.say(player.label(), e.msg);                                // display it in the chat
                player.say(e.msg);
                controller.playNotification();
            });

            pusher.channel.bind("client-rename", function(e) {                  // When a player is renamed
                var player = display.getPlayer(e.id);
                chat.notify(player.label() + " has changed his name to " + e.name + ".");// display it in the chat
                player.label(e.name);
            });
        }

        bd.removeClass("redagent-loading");
        var onNavClick = function(e, page) {
            e.halt(true);                                                       // Prevent default event
            controller.showPage(page);
            updateScroll();
        };
        bd.delegate("click", controller.closePage, ".redagent-closebutton", controller);// Close button click
        bd.delegate("click", onNavClick, "a.redagent-nav-projects", controller, "Projects");// Nav click
        bd.delegate("click", onNavClick, "a.redagent-nav-contact", controller, "Contact");
        bd.delegate("click", onNavClick, "a.redagent-nav-blog", controller, "Blog");

        var doUpdate = function(pageName) {
            var target, found = false;
            Y.all(".redagent-page-" + pageName + " .redagent-spacer").each(function(n) {
                if (!found) {
                    if (n.get("id") && Y.one("a[href='#" + n.get("id") + "']")) {
                        target = n.get("id");
                    }
                    found = n.getDOMNode().getBoundingClientRect().top >= 0;
                }
            });
            Y.all(".redagent-menu-" + pageName + " .redagent-selected").removeClass("redagent-selected");
            Y.all("a[href='#" + target + "']").addClass("redagent-selected");
        },
            updateScroll = function() {
                doUpdate("projects");
                doUpdate("blog");
            };

        $(window).on('DOMContentLoaded load resize scroll', updateScroll);
        updateScroll();

        if (currentPage !== "Red agent") {
            Crafty.pause();
        }

        var firstmsg = "Welcome on Francois-Xavier's home page.", //            // Introduction text by the bot
            secmsg = "It appears there's only the two of us on this page at the moment. Feel free to look around and ask me if you have any question.";
        Y.later(2000, this, function() {
            chat.say("Red agent", firstmsg);
            display.say("bot", firstmsg);
        });
        Y.later(4000, this, function() {
            chat.say("Red agent", secmsg);
            display.say("bot", secmsg);
        });

        $.localScroll({//                                                       //Set up animated scrolling
            target: 'body',
            duration: 1000,
            hash: true
        });
    });

/* Require config */
require.config({
    baseUrl: 'lib/',
    paths: {
        slick: "slick/slick",
        tinyMCE: 'tinymce/tinymce.min'
            //jquery: "jquery-2.1.1.min"
    },
    shim: {
        tinyMCE: {
            exports: 'tinyMCE',
            init: function() {
                this.tinyMCE.DOM.events.domLoaded = true;
                this.tinyMCE.baseURL = "lib/tinymce";
                this.tinyMCE.suffix = ".min";
                return this.tinyMCE;
            }
        }
        //'slick': {
        //    deps: ['jquery'],
        //    exports: 'jQuery.fn.slick'
        //},
        //jquery: {
        //    exports: "jQuery"
        //}
    }
});
