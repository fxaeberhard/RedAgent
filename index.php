<?php
require_once 'php/Tools.php';

if (!isset($page)) {
    $page = "Red agent";
}
$convoId = get_convo_id();
?>
<!DOCTYPE html>
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

            <!-- Blog page -->
            <article class="redagent-page redagent-page-blog" <?php echo ($page !== "Blog") ? 'style="display:none;opacity: 0"' : '' ?>>
                <?php
                if ($page === "Blog") {
                    include 'page-blog.php';
                }
                ?>
            </article>

            <!-- Menu -->
            <article class="redagent-menu" <?php echo ($page === "Red agent") ? 'style="display:none;opacity: 0"' : '' ?>>
                <!--style="display:none;opacity: 0"-->
                <div role="main" class="cf">
                    <div class="redagent-closebutton"></div>
                    <div class="redagent-submenu redagent-menu-projects" <?php echo ($page !== "Projects") ? 'style="display:none;opacity: 0"' : '' ?>>
                        <a href="#proggame" class="redagent-selected">2014</a>
                        <a href="#stalker" >2013</a>
                        <a href="#wegas" >2011</a>
                        <a href="#mjte">2010</a>
                        <a href="#3dblogosphere">2009</a>
                        <a href="#redcms">2005</a>
                        <a href="#schlempf">2004</a>
                        <!--<a href="#yuimyadmin">2003</a>-->
                    </div>


                    <div class="redagent-submenu redagent-menu-blog" <?php echo ($page !== "Blog") ? 'style="display:none;opacity: 0"' : '' ?>>
                        <a href="#2014" class="redagent-selected">2014</a>
                        <!--<a href="#yuimyadmin">2003</a>-->
                    </div>
                </div>
            </article>

            <!-- Main page -->
            <article class="redagent-page-main">
                <header></header>

                <div id="main" role="main" class="cf" style="padding-top:10px">

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
                        François-Xavier Aeberhard homepage
                        <div style="float:right">
                            ©2013 
                            <a class="redagent-nav-projects" href="projects.html">Projects</a>
                            | <a class="redagent-nav-contact" href="contact.html">Contact</a>
                            | <a class="redagent-nav-blog" href="blog.html">Blog</a>
                            | Created with <a target="_blank" href="http://redcms.red-agent.com">RedCMS</a>
                        </div>
                    </footer>

                </div><!-- /main -->
            </article>
        </div><!-- /container -->

        <!-- Media queries for IE < 9 -->
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- YUI3 -->
        <!--<script type="text/javascript" src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>-->
        <script type="text/javascript" src="lib/yui3/build/yui/yui-min.js"></script>

        <!-- Pusher -->
        <script type="text/javascript" src="http://js.pusher.com/2.2/pusher.min.js"></script>

        <!-- Libraries (Crafty, shadowbox, jQuery, Modernizer) -->
        <script type="text/javascript" src="php/min/f=lib/modernizr-1.7.min.js,lib/shadowbox/shadowbox.js,lib/crafty-mod.js,lib/jquery-2.1.1.min.js,lib/jquery.scrollTo/jquery.scrollTo.min.js,lib/jquery.localScroll/jquery.localScroll.min.js,lib/jquery.jeditable.mini.js"></script>

        <!-- Variables -->
        <script type="text/javascript" >
            var currentPage = "<?php echo $page; ?>",
                convoId = "<?php echo $convoId; ?>";
        </script>

        <!-- Scripts -->
        <script type="text/javascript" src="php/min/f=js/redagent-chat.js,js/redagent-display.js,js/redagent-pusher.js,js/redagent-controller.js,js/redagent.js"></script>

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
