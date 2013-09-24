YUI({
    useBrowserConsole: true
}).use("base", "widget", "scrollview", "button", "timers", "event-key", "json", // YUI 3 modules to load
        "transition", "io", "imageloader", "event-mouseenter", "history",
        "gallery-yui-slideshow",
        "redagent-display", "redagent-chat", "redagent-pusher", function(Y) {
    var chat, display,
            pusher = new Y.RedAgent.Pusher(), // Websocket facade
            history = new Y.History({// History manager
        initialState: {
            page: ''
        }
    });

    display = new Y.RedAgent.Display();                                         // Render Crafty drawing area (canvas)
    display.render(Y.one(".cr"));

    chat = new Y.RedAgent.Chat();                                               // Render chat
    chat.render(Y.one(".scrollview-container"));

    Y.on("domready", function() {
        if (!pusher.channel) {                                                  // If no channel is detected,
            return;                                                             // do not continue (for offline debug)
        }

        chat.on("chatEnter", function(e) {                                      // When chat input is entered
            if (pusher.channel.members.count > 1) {                             // and there is other players in the chat,
                pusher.channel.trigger("client-chat", {
                    name: "Anonymous",
                    msg: e.msg,
                    id: pusher.channel.members.me.id
                });                                                             // send websocket event
            } else {                                                            // Otherwise, player is alone
                Y.io("http:///www.red-agent.com/programo/chatbot/conversation_start.php", {// send io request to chatter bot
                    method: "POST",
                    data: "say=" + encodeURIComponent(e.msg)
                            + "&convo_id=" + pusher.channel.members.me.id
                            + "&bot_id=1&format=json",
                    on: {
                        success: function(e) {
                            var response = Y.JSON.parse(e.responseText);
                            chat.say("Red agent", response.botsay);
                        }
                    }
                });
            }
        });

        pusher.channel.bind("client-chat", function(e) {                        // When a chat message is received through websocket
            chat.say(e.name, e.msg);                                            // display it in the chat
        });

        pusher.channel.bind('pusher:subscription_succeeded', function(members) {// On connection to the channel,
            Y.log("Presence channel subscription_succeeded, count: " + members.count);
            members.each(Y.bind(display.addPlayer, display));                   // display all members that are already on the channel
        });

        pusher.channel.bind('pusher:member_added', function(member) {           // When somebody connect,
            Y.log("Member added, count: ", pusher.channel.members.count);
            display.addPlayer(member);                                           // display the newcomer

            pusher.channel.trigger("client-jump", {
                id: pusher.channel.members.me.id,
                x: display.player.x,
                y: display.player.y
            });                                                                 // and send pusher event to update newcomer about current postion
        });

        pusher.channel.bind('pusher:member_removed', function(member) {         // When somebody disconnect
            Y.log("Member removed, count ", pusher.channel.members.count);
            display.getPlayer(member.id).destroy();
        });

        pusher.channel.bind('client-move', function(e) {                        // When somebody moves
            Y.log("Client-move", e);
            display.getPlayer(e.id).moveTo(e.x, e.y).initialized = true;        // update it's sprite
        });

        pusher.channel.bind('client-jump', function(e) {                        // Postion update event, so players are at the right position at the beginning
            Y.log("Client-jump", e);
            var entity = display.getPlayer(e.id);
            if (!entity.initialized) {
                entity.attr({x: e.x, y: e.y}).initialized = true;
            }
        });
    });

    if (Y.SlideShow) {
        Y.all(".slideshow").each(function(node) {                                   // Init slideshows in project page
            new Y.Slideshow({
                srcNode: node,
                transition: Y.Slideshow.PRESETS.slideRight,
                duration: 1,
                interval: 3
                        //nextButton: '#someID'
            }).render();
        });
    }

    Shadowbox.init();                                                           // Init Shadow box

    new Y.Button({
        label: "Send mail",
        on: {
            click: function() {                                                 // On click,
                Y.io("sendMail.php", {
                    method: 'POST',
                    data: "from=" + encodeURIComponent(Y.one(".redagent-page-contact input").get("value"))
                            + "&msg=" + encodeURIComponent(Y.one(".redagent-page-contact textarea").get("value"))
                });                                                             // call send mail method
                Y.one(".redagent-sendmail")
                        .setContent("<em><center><br />Your mail has been sent, I'll get back to you as soon as possible.</center></em>");
            }
        }
    }).render(".redagent-sendmail-button");                                     // Create send mail butto

    var foldGroup = new Y.ImgLoadGroup({// Create ImgLoadGroup for image lazy loading
        name: 'projects group',
        className: "redagent-image",
        foldDistance: 25
    });
    Y.all(".redagent-image").each(function(n) {
        foldGroup.registerImage({
            domId: n.generateID(),
            srcUrl: n.getAttribute("data-src")
        });
    });
    //foldGroup.addTrigger(window, 'scroll');

    Y.one("body").delegate("click", function() {                                // When user click on the close button,
        Y.all(".redagent-page").hide(true);                                     // hide any displayed page button
        Y.one(".redagent-menu").hide(true);                                     // and hide button
        //display.windowOpened = false;
    }, ".redagent-closebutton");

    function showPage(e, selector) {                                            // Show a page
        Y.all(".redagent-page").hide(true);
        Y.one(selector).show(true);
        Y.one(".redagent-menu").show(true);
        foldGroup.fetch();

        if (selector.indexOf("contact") > -1) {
            history.addValue('page', "contact", {
                title: 'Contact - Francois-Xavier Aeberhard',
                url: '/contact.php'
            });
        } else {
            history.addValue('page', "contact", {
                title: 'Projects - Francois-Xavier Aeberhard',
                url: '/projects.php'
            });
        }
    }

    Y.RedAgent.showPage = showPage;
    Y.one("body").delegate("click", showPage, "a.redagent-nav-projects", null, ".redagent-page-projects");
    Y.one("body").delegate("click", showPage, "a.redagent-nav-contact", null, ".redagent-page-contact");

    Y.one("body").removeClass("redagent-loading");
    chat.say("Red agent", "Welcome on Francois-Xavier's profile. I'm a bot and"
            + "it appears there's only the two of us on this page at the moment."
            + "Feel free to look around and ask me if you have any question.");

});
