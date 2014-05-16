/*
 * Red agent
 * http://www.red-agent.com/wallogram
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI.add("redagent-controller", function(Y) {

    var Controller = Y.Base.create("redagent-controller", Y.Base, [], {
        initializer: function() {
            this.history = new Y.History({
                initialState: {
                    page: ''
                }
            });                                                                 // Init history manager
            this.history.on('pageChange', this.onPageChange, this);             // Watch page changes

            Shadowbox.init();                                                   // Init Shadow box

            //this.foldGroup = new Y.ImgLoadGroup({
            //    name: 'projects group',
            //    className: "redagent-image",
            //    foldDistance: 25
            //});                                                               // Create ImgLoadGroup for image lazy loading

            Y.RedAgent.controller = this;
        },
        showPage: function(e, title) {                                          // Show a page
            if (e) {                                                            // Prevent default event
                e.halt(true);
            }

            this.history.addValue('page', title, {
                title: title + ' - Francois-Xavier Aeberhard',
                url: title.toLowerCase() + '.html'
            });                                                                 // Update browser history
        },
        closePage: function() {
            this.history.addValue('page', "Red agent", {
                title: 'Red agent - Francois-Xavier Aeberhard',
                url: '/'
            });
            //display.windowOpened = false;
        },
        onPageChange: function(e) {                                             // When history changes,
            Y.log("Page history changed:" + e.newVal, "info", "RedAgent.Controller");

            if (e.newVal === "Red agent") {
                Y.all(".redagent-page").hide(true);                             // hide any displayed page button
                Y.later(1000, this, function() {
                    Y.all(".redagent-page").empty();
                });
                Y.one(".redagent-menu").hide(true);                             // and hide button
                Y.all(".redagent-submenu").hide(true);
                if (Crafty.isPaused())
                    Crafty.pause();
            } else {
                var title = e.newVal,
                        targetNode = Y.one(".redagent-page-" + title.toLowerCase());
                Y.all(".redagent-page").hide(true);                             // hide any displayed page button
                Y.all(".redagent-submenu").hide(true);
                Y.one(".redagent-menu").show(true);                             // Show menu
                targetNode.show(true).addClass("redagent-page-loading");        // Show page
                this.currentPage = title;                                       // Save current page
                if (title === "Projects") {
                    Y.all(".redagent-submenu").show(true);
                }

                if (!Crafty.isPaused())
                    Crafty.pause();

                Y.io("page-" + title.toLowerCase() + ".php", {
                    context: this,
                    on: {
                        success: function(tId, e) {
                            targetNode.setContent(e.responseText)
                                    .removeClass("redagent-page-loading");
                            this.sync();
                        }
                    }
                });                                                             // Fetch page content from server
                //this.showPage(null, e.newVal);
            }
        },
        sync: function() {
            Shadowbox.clearCache();                                             // Update shadowbox links
            Shadowbox.setup();

            if (Y.Slideshow) {
                Y.all(".slideshow").each(function(node) {                       // Init slideshows in project page
                    if (!node.slinit) {
                        new Y.Slideshow({
                            srcNode: node,
                            //transition: Y.Slideshow.PRESETS.slideRight,
                            duration: 1,
                            interval: 3
                                    //nextButton: '#someID'
                        }).render();
                        node.slinit = true;
                    }
                });
            }

            var sendMailNode = Y.one(".redagent-sendmail-button");
            if (sendMailNode) {
                new Y.Button({
                    label: "Send mail",
                    on: {
                        click: function() {                                     // On click,
                            Y.io("php/sendMail.php", {
                                method: 'POST', // call send mail method
                                data: "from=" + encodeURIComponent(Y.one(".redagent-page-contact input").get("value"))
                                        + "&msg=" + encodeURIComponent(Y.one(".redagent-page-contact textarea").get("value"))
                            });
                            Y.one(".redagent-sendmail")
                                    .setContent("<em><center><br />Your mail has been sent, I'll get back to you as soon as possible.</center></em>");
                        }
                    }
                }).render(sendMailNode);                                        // Create send mail button
            }

            //Y.all(".redagent-image").each(function(n) {
            //    this.foldGroup.registerImage({
            //        domId: n.generateID(),
            //        srcUrl: n.getAttribute("data-src")
            //    });
            //}, this);
            //foldGroup.addTrigger(window, 'scroll');
            //foldGroup.fetch();
        }
    });
    Y.namespace("RedAgent").Controller = Controller;

});
