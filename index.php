<?php
require_once 'php/Tools.php';

if (!isset($page)) {
    $page = "Red agent";
}
$convoId = get_convo_id();
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $page ?> - Francois-Xavier Aeberhard</title>
        <meta name="description" content="">
        <meta name="author" content="Francois-Xavier Aeberhard">
        <meta name="contact" content="fx@red-agent.com">
        <meta name="keywords" content="françois-xavier, aeberhard, gamedesign, webdesign, user experience">
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta http-equiv="cleartype" content="on" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="shortcut icon" href="favicon.ico">
        <!--<link rel="apple-touch-icon" href="link to touch icon">-->

        <!-- Shadowbox -->
        <link rel="stylesheet" type="text/css" href="js/lib/shadowbox/shadowbox.css">

        <!-- Layout -->
        <link rel="stylesheet" href="css/global.css" media="all">
        <link rel="stylesheet" href="css/layout.css" media="all and (min-width: 53.236em)">
        <!--[if (lt IE 9) & (!IEMobile)]>
        <link rel="stylesheet" href="css/example/layout.css" media="all">
        <![endif]-->

        <!-- Site styles -->
        <link rel="stylesheet" href="css/redagent.css" media="all">

    </head>

    <body class="yui3-skin-sam redagent-loading">

        <div id="container" class="cf">

            <!-- Contact-page -->
            <article class="redagent-page redagent-page-contact" <?php echo ($page !== "Contact") ? 'style="display:none;opacity: 0"' : '' ?> >
                <?php
                if ($page === "Contact") {
                    include 'page-contact.php';
                }
                ?>
            </article>

            <!-- Projects page -->
            <article class="redagent-page redagent-page-projects" <?php echo ($page !== "Projects") ? 'style="display:none;opacity: 0"' : '' ?>>
                <?php
                if ($page === "Projects") {
                    include 'page-projects.php';
                }
                ?>
            </article>

            <!-- Menu -->
            <article class="redagent-menu" <?php echo ($page === "Red agent") ? 'style="display:none;opacity: 0"' : '' ?>>
                <!--style="display:none;opacity: 0"-->
                <div role="main" class="cf">
                    <div class="redagent-submenu redagent-menu-project" <?php echo ($page !== "Projects") ? 'style="display:none;opacity: 0"' : '' ?>>
                        <a href="#wallogram" class="redagent-selected">2012</a>
                        <a href="#mjte">2011</a>
                        <a href="#3dblogosphere">2010</a>
                        <a href="#redcms">2009</a>
                        <a href="#schlempf">2004</a>
                        <!--<a href="#yuimyadmin">2003</a>-->
                    </div>
                    <div class="redagent-closebutton"></div>
                </div>
            </article>

            <!-- Main page -->
            <article class="redagent-page-main">
                <header></header>

                <div id="main" role="main" class="cf">

                    <!-- Crafty stage -->
                    <p class="intro cr" style="float:left"></p>

                    <!-- Chat -->
                    <aside>
                        <div class="scrollview-container">
                            <div>
                                <div class="yui3-scrollview-loading"><ul></ul></div>
                                <div class="form">
                                    <textarea placeholder="Type here to chat"></textarea>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <div style="clear:both"></div>

                    <footer class="cf">
                        <a class="redagent-nav-projects" href="projects.html">Projects</a>
                        | <a class="redagent-nav-contact" href="contact.html">Contact</a>
                        | Powered by <a target="_blank" href="http://redcms.red-agent.com">RedCMS</a>
                        | ©2013 Francois-Xavier Aeberhard
                    </footer>

                </div><!-- /main -->

            </article>

        </div><!-- /container -->

        <!-- Media queries for IE < 9 -->
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- Modernizer for IE -->
        <script type="text/javascript" src="js/lib/modernizr-1.7.min.js"></script>

        <!-- YUI3 -->
        <!--<script type="text/javascript" src="http://yui.yahooapis.com/3.12.0/build/yui/yui-min.js"></script>-->
        <script type="text/javascript" src="js/lib/yui3/build/yui/yui-min.js"></script>

        <!-- Pusher -->
        <script type="text/javascript" src="http://js.pusher.com/2.2/pusher.min.js"></script>

        <!-- Shadow box -->
        <script type="text/javascript" src="js/lib/shadowbox/shadowbox.js"></script>

        <!-- Crafty -->
        <script type="text/javascript" src="js/lib/crafty-mod.js"></script>

        <!-- Site scripts -->
        <script type="text/javascript" src="./js/redagent-chat.js"></script>
        <script type="text/javascript" src="./js/redagent-display.js"></script>
        <script type="text/javascript" src="./js/redagent-pusher.js"></script>
        <script type="text/javascript" src="./js/redagent-controller.js"></script>

        <!-- Run -->
        <script type="text/javascript" >
            YUI({
                useBrowserConsole: true
            }).use("base-build", "widget", "scrollview", "button", "timers", "json-parse", // Dependencies
                    "transition", "io-base", "history", "event-key", "event-mouseenter",
                    "gallery-yui-slideshow", "node-screen", //"galler-scrollintoview", 
                    "redagent-display", "redagent-chat", "redagent-pusher",
                    "redagent-controller", function(Y) {

                        var bd = Y.one("body"),
                                currentPage = "<?php echo $page; ?>",
                                convoId = "<?php echo $convoId; ?>",
                                controller = new Y.RedAgent.Controller(), // Pages controller (history, loading, etc.)
                                pusher = new Y.RedAgent.Pusher(), // Websocket facade
                                display = new Y.RedAgent.Display(), // Render Crafty drawing area (canvas)
                                chat = new Y.RedAgent.Chat({
                                    srcNode: ".scrollview-container div"
                                });
                        display.render(Y.one(".cr"));

                        chat.render();                                          // Render chat

                        controller.sync();                                      // Sync pages

                        Y.on("domready", function() {
                            chat.on("chatEnter", function(e) {                  // When chat input is entered

                                display.say("You", e.msg);                      // Show msg in the canvas

                                if (pusher.channel && pusher.channel.members.count > 1) {// and there are other players in the chat,
                                    pusher.channel.trigger("client-chat", {
                                        name: "Anonymous",
                                        msg: e.msg,
                                        id: pusher.channel.members.me.id
                                    });                                         // send websocket event
                                } else {                                        // Otherwise, player is alone
                                    Y.io("programo/chatbot/conversation_start.php", {// send io request to chatter bot
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

                            if (!pusher.channel) {                              // If no channel is detected,
                                return;                                         // do not continue (for offline debug)
                            }

                            pusher.channel.bind("client-chat", function(e) {    // When a chat message is received through websocket
                                chat.say(e.name, e.msg);                        // display it in the chat
                                display.say(e.id, e.msg);
                            });

                            pusher.channel.bind('pusher:subscription_succeeded', function(members) {// On connection to the channel,
                                Y.log("Presence channel subscription_succeeded, count: " + members.count);
                                members.each(function(m) {                      // display all members that are already on the channel
                                    if (m.id !== members.myID) {
                                        display.addPlayer(m);
                                    }
                                });
                            });

                            pusher.channel.bind('pusher:member_added', function(member) {// When somebody connect,
                                Y.log("Member added, count: ", pusher.channel.members.count);
                                display.addPlayer(member);                      // display the newcomer

                                pusher.channel.trigger("client-jump", {// and send him a message to tell our actual position
                                    id: pusher.channel.members.me.id,
                                    x: display.player.x,
                                    y: display.player.y
                                });                                             // and send pusher event to update newcomer about current postion
                            });

                            pusher.channel.bind('pusher:member_removed', function(member) {// When somebody disconnect
                                Y.log("Member removed, count ", pusher.channel.members.count);
                                display.getPlayer(member.id).destroy();
                            });

                            pusher.channel.bind('client-move', function(e) {    // When somebody else moves,
                                Y.log("Client-move", e);
                                display.getPlayer(e.id).moveTo(e.x, e.y)
                                        .initialized = true;                    // update it's sprite
                            });

                            pusher.channel.bind('client-jump', function(e) {    // Postion update event, so players are at the right position at the beginning
                                Y.log("Client-jump", e);
                                var entity = display.getPlayer(e.id);
                                if (!entity.initialized) {
                                    entity.attr({x: e.x, y: e.y}).initialized = true;
                                }
                            });
                        });

                        bd.removeClass("redagent-loading");
                        bd.delegate("click", controller.closePage, ".redagent-closebutton", controller);// Close button click
                        bd.delegate("click", controller.showPage, "a.redagent-nav-projects", controller, "Projects");// Nav click
                        bd.delegate("click", controller.showPage, "a.redagent-nav-contact", controller, "Contact");

                        var updateScroll = function() {
                            var target, found = false;
                            Y.all(".redagent-page-projects .cf > *[id]").each(function(n) {
                                if (found) {
                                } else if (n.get("id") && n.get("docScrollY") + 70 < n.get("region").top) {
                                    found = true;
                                } else {
                                    target = n.get("id");
                                }
                            });
                            if (target && Y.one("a[href='#" + target + "']")) {
                                Y.all(".redagent-selected").removeClass("redagent-selected");
                                Y.one("a[href='#" + target + "']").addClass("redagent-selected");
                            }
                        };
                        window.onscroll = updateScroll;
                        updateScroll();
                        //bd.delegate("click", function(e) {
                        //    Y.one(e.currentTarget.getAttribute("href")).scrollIntoView();
                        //    e.halt(true);
                        //}, ".redagent-submenu a");
                        //Y.all(".redagent-submenu a").on("click", function (e) {
                        //    Y.one(e.currentTarget.getAttribute("href")).scrollIntoView();
                        //    e.halt(true);
                        //});

                        if (currentPage !== "Red agent") {
                            Crafty.pause();
                        }

                        var firstmsg = "Welcome on Francois-Xavier's home page.",
                                secmsg = "It appears there's only the two of us on this page at the moment. Feel free to look around and ask me if you have any question.";
                        chat.say("Red agent", firstmsg);
                        display.say("Red agent", firstmsg);
                        Y.later(4000, this, function() {
                            chat.say("Red agent", secmsg);
                            display.say("Red agent", secmsg);
                        });
                    });
        </script>

        <!-- Google analytics -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-12224039-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </body>

</html>