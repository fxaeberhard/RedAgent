/*
 * Red agent
 * http://www.red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI.add("redagent-controller", function(Y) {

    var Controller = Y.Base.create("redagent-controller", Y.Base, [], {
        windowActive: true,
        initializer: function() {
            this.history = new Y.History({
                initialState: {
                    page: ''
                }
            });                                                                 // Init history manager
            this.history.on('pageChange', this.onPageChange, this);             // Watch page changes

            this.sync();

            $(window).blur(function() {
                Controller.windowActive = false;
            });
            $(window).focus(function() {
                Controller.windowActive = true;
            });

            Y.one(".redagent-search input").on("valuechange", function(e) {     // Search field logic
                Y.all(".redagent-article").setStyle("max-height", "2000px")
                    .each(function(n) {
                        if (e.newVal && n.get("text").toLowerCase().indexOf(e.newVal.toLowerCase()) === -1) {
                            n.setStyle("max-height", "0");
                        }
                    });
            });

            Y.RedAgent.controller = this;
        },
        showPage: function(title) {                                             // Show a page
            this.history.addValue('page', title, {
                title: title + ' - Francois-Xavier Aeberhard',
                url: title.toLowerCase() + '.html'
            });                                                                 // Update browser history
        },
        closePage: function() {
            this.history.addValue('page', "Red agent", {
                title: 'Red agent - Francois-Xavier Aeberhard',
                url: this.getPath()
            });
        },
        onPageChange: function(e) {                                             // When history changes,
            Y.log("Page history changed:" + e.newVal, "info", "RedAgent.Controller");
            Y.all(".redagent-page").hide(true);                                 // hide any displayed page button
            Y.all(".redagent-submenu").hide(true);
            if (e.newVal === "Red agent") {
                Y.later(1000, this, function() {
                    Y.all(".redagent-page").setContent("");
                });
                Y.one(".redagent-menu").hide(true);                             // and hide button
                if (Crafty.isPaused())
                    Crafty.pause();
            } else {
                var title = e.newVal,
                    targetNode = Y.one(".redagent-page-" + title.toLowerCase());

                Y.one(".redagent-menu").show(true);                             // Show menu
                targetNode.show(true).addClass("redagent-page-loading");        // Show page
                this.currentPage = title;                                       // Save current page

                Y.all(".redagent-menu-" + title.toLowerCase()).show(true);      // Show current menu
                Y.one(".redagent-search").toggleView(title !== "contact");

                if (!Crafty.isPaused())
                    Y.later(1000, Crafty, Crafty.pause());

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
            }
        },
        sync: function() {
            $(".fancybox").fancybox({//                                         // Update fancybox links
                padding: 0,
                autoPlay: true,
//                prevEffect: 'none',
//                nextEffect: 'none',
                helpers: {
                    title: {
//                        type: 'outside'
                    },
                    thumbs: {
                        width: 80,
                        height: 80,
                        source: function(current) {
                            var e = $(current.element);
                            if (e.data('thumbnail'))
                                return $(current.element).data('thumbnail');
                            else
                                return e.find("img").attr("src");
                        }
                    }
                }
            });

            if (Y.one(".slideshow")) {
                require(["slick"], function() {
                    $('.slideshow').slick({
                        lazyLoad: "ondemand",
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        fade: true,
                        arrows: false
                            // adaptiveHeight: true, vertical: true, slidesToShow: 1, speed: 300, dots: true, cssEase: 'linear',
                    });
                });
            }

            var sendMailNode = Y.one(".redagent-sendmail-button");
            if (sendMailNode) {
                Y.use("button", function() {
                    new Y.Button({
                        labelHTML: '<i class="fa fa-envelope"></i> Send',
                        on: {
                            click: function() {                                 // On click,
                                Y.io("php/sendMail.php", {
                                    method: 'POST', //                          // call send mail method
                                    data: "from=" + encodeURIComponent(Y.one(".redagent-page-contact input").get("value"))
                                        + "&msg=" + encodeURIComponent(Y.one(".redagent-page-contact textarea").get("value"))
                                });
                                Y.one(".redagent-sendmail")
                                    .setContent("<em><center><br />Your mail has been sent, I'll get back to you as soon as possible.</center></em>");
                            }
                        }
                    }).render(sendMailNode);                                    // Create send mail button
                });
            }

            if (Y.one(".page-blog textarea")) {                                 // Init TinyMCE on blog.html page
                this.initTinyMCE();
            }

            $(".youtube-player").click(function() {                             // Youtube video lazy load  width="420" height="236" 
                $(this).html('<iframe class="youtube-iframe" title="YouTube video player" src="http://www.youtube.com/embed/' + $(this).data("id") + '?autoplay=1&rel=0&controls=1&autohide=1&color2=580000&showinfo=0&modestbranding=1&rel=0" frameborder="0" allowfullscreen></iframe>');
            });
            //.each(function() {
            //    $(this).append('<img class="youtube-thumb" src="//i.ytimg.com/vi/' + $(this).data("id") + '/hqdefault.jpg"><div class="play-button"></div>');
            //});
        },
        getPath: function() {
            var loc = window.location.pathname;
            return loc.substring(0, loc.lastIndexOf('/') + 1);
        },
        playNotification: function() {
            if (!Controller.windowActive) {
                Y.log("Controller.playNotification()");
                new Audio('images/Air Plane Ding.mp3').play();
            }
        },
        initTinyMCE: function() {
            requirejs(['tinyMCE'], function(tinyMCE) {
                tinyMCE.init({
                    selector: '.page-blog textarea',
                    plugins: "autolink link image code media table contextmenu save emoticons  autoresize",
                    toolbar: "bold italic link image emoticons code styleselect save",
                    image_advtab: true,
                    statusbar: false,
                    menubar: false,
                    save_enablewhendirty: true,
                    toolbar_items_size: 'small',
                    forced_root_block: false, //                                // Prevent enter from creating p elements
                    autoresize_min_height: 45,
                    autoresize_bottom_margin: 0,
                    save_onsavecallback: function(editor) {
                        Y.io("page-blog.php", {
                            method: "POST",
                            data: {
                                op: "comment",
                                file: Y.one(editor.contentAreaContainer).ancestor(".blog-post").getAttribute("data-post"),
                                comment: editor.getContent()
                            },
                            on: {
                                success: function(tId, e) {
                                    Y.one(editor.contentAreaContainer).ancestor(".blog-post").one("div").setHTML(e.responseText);
                                    editor.setContent("");
                                }
                            }
                        });
                    },
                    setup: function(editor) {
                        var placeholder = $("<label>" + editor.getElement().getAttribute("placeholder") + "</label>")
                            .css({position: 'absolute', top: '2px', left: 0, color: 'lightgray', padding: '0.5%', width: '99%', overflow: 'hidden'})
                            .click(function() {
                                $(this).hide();
                                editor.focus();
                            });

                        editor.on('init', function(evt) {
                            var editor = evt.target,
                                toolbar = $(editor.editorContainer).find('>.mce-container-body >.mce-toolbar-grp'),
                                editorNode = $(editor.editorContainer).find('>.mce-container-body >.mce-edit-area');
                            toolbar.detach().insertAfter(editorNode);           // switch the order of the elements

                            $(editor.contentAreaContainer).css("position", "relative")
                                .append(placeholder);

                            $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
                        });
                        editor.on('focus', function() {
                            $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
                            placeholder.hide();
                        });
                        editor.on('blur', function() {
                            if (this.getContent() === '') {
                                $(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
                                placeholder.show();
                            } else {
                                placeholder.hide();
                            }
                        });
                    }
                });
            });
        }
    });
    Y.namespace("RedAgent").Controller = Controller;
});
