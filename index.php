<!DOCTYPE html>
<html lang="en">

<?php
require_once 'php/Tools.php';
$page = filter_input(INPUT_GET, 'page');
$convoId = get_convo_id();
?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Francois-Xavier Aeberhard">
    <link rel="author" href="https://plus.google.com/+FrancoisXavierAeberhardRed" />
    <meta name="contact" content="fx@red-agent.com">
    <meta name="keywords" content="françois-xavier, aeberhard, gamedesign, webdesign,fdi user experience">
    <meta name="description" content="Francois-Xavier Aeberhard is a user experience engineer, specialized in games and web. This is his portfolio.">

    <title>
      <?php echo $page ? ucfirst($page) : 'Red Agent' ?> - Francois-Xavier Aeberhard</title>

    <!-- Fb -->
    <!-- <meta property="og:url" content="{{pageUrl}}">
    <meta property="og:image" content="{{imageUrl}}">
    <meta property="og:description" content="{{description}}">
    <meta property="og:title" content="{{pageTitle}}">
    <meta property="og:site_name" content="{{siteTitle}}">
    <meta property="og:see_also" content="{{homepageUrl}}">
    <meta property="fb:admins" content="USER_ID" /> -->

    <!-- G+ -->
    <!-- <meta itemprop="name" content="{{pageTitle}}">
    <meta itemprop="description" content="{{description}}">
    <meta itemprop="image" content="{{imageUrl}}"> -->

    <!-- Twitter metas -->
    <!-- <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{pageUrl}}">
    <meta name="twitter:title" content="{{pageTitle}}">
    <meta name="twitter:description" content="{{description}}">
    <meta name="twitter:image" content="{{imageUrl}}"> -->

    <!-- Favicon -->

    <link rel="apple-touch-icon" href="/images/icon/apple.png">
    <link rel="apple-touch-icon" sizes="57x57" href="/images/icon/apple-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/icon/apple-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icon/apple-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icon/apple-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icon/apple-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icon/apple-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icon/apple-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icon/apple-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/icon/apple-180x180.png">
    <link rel="icon" type="image/png" href="/images/icon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/icon/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/images/icon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/images/icon/andro-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/images/icon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/icon/manifest.json">
    <link rel="mask-icon" href="/images/icon/safari-pinned-tab.svg" color="#580000">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/images/icon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- build:css css/styles.css -->
    <!-- Libraries -->
    <link rel="stylesheet" href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="bower_components/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" href="bower_components/photoswipe/dist/photoswipe.css">
    <!-- <link rel="stylesheet" href="bower_components/photoswipe/dist/default-skin/default-skin.css"> -->
    <!-- <link rel="stylesheet" href="bower_components/slick-carousel/slick/slick-theme.css" /> -->

    <!-- Custom styles -->
    <link href="css/redagent.css" rel="stylesheet" />
    <!--endbuild-->
  </head>

  <body>

    <!-- Pages -->
    <section class="page">
      <?php if ($page) include "$page.php"; ?>
    </section>

    <!-- Game -->
    <section class="game">
      <div>
        <div>
          <div id="cr-stage" class="stage"></div>
          <div class="chat">
            <div class="chat-msgs"></div>
            <div>
              <textarea placeholder="Type here to chat"></textarea>
            </div>
          </div>
        </div>

        <?php footer() ?>

      </div>
    </section>

    <!-- Loader -->
    <div class="loader" <?php if ($page) { echo 'style="visibility:hidden"'; } ?>>
      <div></div>
    </div>

    <!-- Photoswipe -->
    <?php include 'php/photoswipe.html'; ?>

    <!-- Variables -->
    <script type="text/javascript">
    var currentPage = "<?php echo $page; ?>",
      convoId = "<?php echo $convoId; ?>";
    </script>

    <!-- build:js js/scripts.js -->
    <!-- Libraries -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/svg4everybody/dist/svg4everybody.legacy.min.js"></script>
    <script src="bower_components/tether/dist/js/tether.min.js"></script>
    <script src="bower_components/bootstrap/js/dist/util.js"></script>
    <script src="bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="bower_components/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js"></script>
    <script src="bower_components/jquery.cookie/jquery.cookie.js"></script>
    <script src="bower_components/crafty/dist/crafty-min.js"></script>
    <script src="bower_components/photoswipe/dist/photoswipe.min.js"></script>
    <script src="bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script>
    <script src="bower_components/pusher/dist/pusher.min.js"></script>
    <script src="bower_components/webfontloader/webfontloader.js"></script>
    <script src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script src="js/scrollspy.js"></script>
    <script src="js/slick.js"></script>
    <!-- <script src="bower_components/slick-carousel/slick/slick.min.js"></script> -->
    <!-- <script src="bower_components/requirejs/require.js"></script> -->

    <!-- Scripts -->
    <script src="js/redagent-game.js"></script>
    <script src="js/redagent-net.js"></script>
    <script src="js/redagent.js"></script>
    <!-- endbuild -->

    <!-- Google analytics -->
    <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-12224039-1', 'auto');
    ga('send', 'pageview');
    </script>

    <!-- Google Knowledge Graph -->
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Person",
      "name": "Francois-Xavier Aeberhard",
      "url": "http://www.red-agent.com",
      "sameAs": [
        "https://plus.google.com/+FrancoisXavierAeberhardRed",
        "https://www.youtube.com/c/FrancoisXavierAeberhardRed",
        "http://www.linkedin.com/in/francoisxavieraeberhard"
      ]
    }
    </script>


  </body>

</html>
