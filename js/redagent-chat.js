YUI.add("redagent-chat", function(Y) {

    var Chat = Y.Base.create("redagent-chat", Y.Widget, [], {
        renderUI: function() {
            var cb = this.get("contentBox");

            this.scrollView = new Y.ScrollView({
                srcNode: cb.one(".yui3-scrollview-loading"),
                height: 544,
                flick: {
                    minDistance: 10,
                    minVelocity: 0.3,
                    axis: "y"
                }
            });
            this.scrollView.render();                                           // Render scrollview

            cb.one("textarea").on("key", function(e) {                          // On "enter" key in textarea,
                var value = e.target.get("value");

                Y.soon(Y.bind(e.target.set, e.target, "value", ""));            // empty, textarea
                //e.target.set("value", "");                                    // empty, textarea

                if (value === "") {
                    return;
                }

                this.say("You", value, "self");                                 // show the value
                this.fire("chatEnter", {// Send event
                    msg: value
                });
            }, "13", this);
        },
        bindUI: function() {
            return;
            var content = this.scrollView.get("contentBox");

            content.delegate("click", function(e) {                             // Prevent links from navigating as part of a scroll gesture
                if (Math.abs(this.scrollView.lastScrolledAmt) > 2) {
                    e.preventDefault();
                    Y.log("Link behavior suppressed.");
                }
            }, "a");

            content.delegate("mousedown", function(e) {                         // Prevent default anchor drag behavior, on browsers which let you drag anchors to the desktop
                e.preventDefault();
            }, "a");
        },
        say: function(name, msg, cssclass) {
            this.scrollView.get("contentBox").one("ul").append("<li class=\"" + (cssclass || "msg") + "\">" + name + ": " + msg + "</li>");
            this.scrollView._uiDimensionsChange();
            this.scrollView.scrollTo(0, this.scrollView._maxScrollY, 1000);
        }
    });
    Y.namespace("RedAgent").Chat = Chat;

});
