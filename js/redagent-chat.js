/*
 * Red agent
 * http://www.red-agent.com/wallogram
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI.add("redagent-chat", function(Y) {

    var Chat = Y.Base.create("redagent-chat", Y.Widget, [], {
        CONTENT_TEMPLATE: '<div>'
            + '<div class="chat-msgs"></div>'
            + '<div><textarea placeholder="Type here to chat"></textarea></div>'
            + '</div>',
        renderUI: function() {
            $('.chat-msgs').perfectScrollbar();

            this.get("contentBox").one("textarea").on("key", function(e) {      // On "enter" key in textarea,
                var value = e.target.get("value");

                Y.soon(Y.bind(e.target.set, e.target, "value", ""));            // empty, textarea
                //e.target.set("value", "");                                    // empty, textarea

                if (value === "") {
                    return;
                }

                this.say("Me", value, "self");                                  // show the value
                this.fire("chatEnter", {//                                      // Send event
                    msg: value
                });
            }, "13", this);
        },
        say: function(name, msg, cssclass) {
            this.addParagraph(name + ": " + msg, cssclass);
        },
        notify: function(msg) {
            this.addParagraph(msg, "notification");
        },
        addParagraph: function(msg, cssclass) {
            $('.chat-msgs').append("<div class=\"chat-msg " + cssclass + "\">" + msg + "</div>")
                .animate({
                    scrollTop: $(".chat-msgs").prop("scrollHeight")
                }, 1500)
                .perfectScrollbar('update');
        }
    });
    Y.namespace("RedAgent").Chat = Chat;
});
