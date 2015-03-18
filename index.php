<?php
require_once 'php/Tools.php';

$page = filter_input(INPUT_GET, 'page');
if (!isset($page)) {
    $page = "Red agent";
}
$convoId = get_convo_id();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo ucfirst($page) ?> - Francois-Xavier Aeberhard</title>
        <meta name="author" content="Francois-Xavier Aeberhard" />
        <meta name="contact" content="fx@red-agent.com" />
        <meta name="keywords" content="françois-xavier, aeberhard, gamedesign, webdesign, user experience" />
        <meta name="description" content="">
        <meta charset="utf-8" />
        <meta name="robots" content="index, follow" />
        <meta http-equiv="cleartype" content="on" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="favicon.ico" />

        <!-- CSS Libraries (shadobox, fontawesome) -->
        <link rel="stylesheet" href="lib/shadowbox/shadowbox.css" />
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="lib/perfect-scrollbar/css/perfect-scrollbar.min.css" />

        <!-- Site styles -->
        <link rel="stylesheet" href="css/global.css" media="all" />
        <link rel="stylesheet" href="css/layout.css" media="all and (min-width: 53.236em)" />
        <!--[if (lt IE 9) & (!IEMobile)]>
        <link rel="stylesheet" href="css/layout.css" media="all" />
        <![endif]-->
        <link rel="stylesheet" href="css/redagent.css" media="all" />

    </head>

    <body class="yui3-skin-sam redagent-loading">

        <div id="container" class="cf">

            <?php
            $pages = array("contact", "projects", "blog");
            foreach ($pages as $p) {
                ?>
                <article class="redagent-page redagent-page-<?php echo $p ?>" <?php echo ($page !== $p) ? 'style="display:none;opacity: 0"' : '' ?> >
                    <?php
                    if ($page === $p) {
                        include "page-$p.php";
                    }
                    ?>
                </article>
            <?php } ?>

            <!-- Menu -->
            <article class="redagent-menu" <?php echo ($page === "Red agent") ? 'style="display:none;opacity: 0"' : '' ?>>
                <div role="main" class="cf">
                    <div class="redagent-closebutton"></div>

                    <div class="redagent-submenu redagent-menu-projects" <?php echo ($page !== "projects") ? 'style="display:none;opacity: 0"' : '' ?>>
                        <a href="#proggame" class="redagent-selected">2014</a>
                        <a href="#stalker" >2013</a>
                        <a href="#wegas" >2011</a>
                        <a href="#mjte">2010</a>
                        <a href="#3dblogosphere">2009</a>
                        <a href="#redcms">2005</a>
                        <a href="#schlempf">2004</a>
                        <!--<a href="#yuimyadmin">2003</a>-->
                    </div>

                    <div class="redagent-submenu redagent-menu-blog" <?php echo ($page !== "blog") ? 'style="display:none;opacity: 0"' : '' ?>>
                        <a href="#2014" class="redagent-selected">2014</a>
                        <!--<a href="#yuimyadmin">2003</a>-->
                    </div>
                </div>
            </article>

            <!-- Main page -->
            <article>
                <div id="main" role="main" class="cf">

                    <!-- Crafty stage -->
                    <p class="intro cr"></p>

                    <!-- Chat -->
                    <aside>
                        <div class="scrollview-container"></div>
                    </aside>
                    <div style="clear:both"></div>

                    <footer class="cf">
                        <?php include 'php/footer.php'; ?>
                    </footer>

                </div>
            </article>
        </div>

        <!-- Media queries for IE < 9 -->
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- YUI3 -->
        <script type="text/javascript" src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>
        <!--<script type="text/javascript" src="lib/yui3/build/yui/yui-min.js"></script>-->

        <!-- Pusher -->
        <script type="text/javascript" src="http://js.pusher.com/2.2/pusher.min.js"></script>

        <!-- Libraries (Crafty, shadowbox, jQuery, Modernizer) -->
        <script type="text/javascript" src="php/min/f=lib/modernizr-1.7.min.js,lib/shadowbox/shadowbox.js,lib/jquery-2.1.1.min.js,lib/jquery.scrollTo/jquery.scrollTo.min.js,lib/jquery.localScroll/jquery.localScroll.min.js,lib/jquery.jeditable.mini.js,lib/crafty-mod.js,lib/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js"></script>

        <!-- Variables -->
        <script type="text/javascript" >
            var currentPage = "<?php echo $page; ?>",
                convoId = "<?php echo $convoId; ?>";
        </script>

        <!-- Scripts -->
        <script type="text/javascript" src="php/min/f=js/redagent-chat.js,js/redagent-display.js,js/redagent-pusher.js,js/redagent-controller.js,js/redagent.js"></script>
        <!--<script type="text/javascript" src="js/redagent-chat.js"></script>
        <script type="text/javascript" src="js/redagent-display.js"></script>
        <script type="text/javascript" src="js/redagent-pusher.js"></script>
        <script type="text/javascript" src="js/redagent-controller.js"></script>
        <script type="text/javascript" src="js/redagent.js"></script>-->

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
