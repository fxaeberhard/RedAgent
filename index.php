<!DOCTYPE html>
<html lang="en">

<?php
require_once 'php/app.php';
global $page;
$page = filter_input(INPUT_GET, 'page');
// $convoId = get_convo_id();
?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo title($page) ?></title>
	<meta name="description" content="<?php description($page)?>">
	<meta name="author" content="Francois-Xavier Aeberhard">
	<link rel="author" href="https://plus.google.com/+FrancoisXavierAeberhardRed" />
	<meta name="contact" content="fx@red-agent.com">
	<meta name="keywords" content="François-Xavier Aeberhard, Engineer, Game Design, Webdesign, User Experience, Portfolio">

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
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icon/apple-180x180.png">
	<link rel="icon" type="image/png" href="/assets/images/icon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/assets/images/icon/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/assets/images/icon/manifest.json">
	<link rel="mask-icon" href="/assets/images/icon/safari-pinned-tab.svg" color="#580000">
	<link rel="shortcut icon" href="/assets/images/icon/favicon.ico">
	<meta name="msapplication-config" content="/assets/images/icon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<!-- build:css css/styles.css -->
	<!-- Libraries -->
	<link rel="stylesheet" href="bower_components/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="bower_components/photoswipe/dist/photoswipe.css">
	<link rel="stylesheet" href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" />
	<!-- <link rel="stylesheet" href="bower_components/photoswipe/dist/default-skin/default-skin.css"> -->
	<!-- <link rel="stylesheet" href="bower_components/slick-carousel/slick/slick-theme.css" /> -->
	<!-- Custom styles -->
	<link rel="stylesheet" href="css/redagent.css">
	<!--endbuild-->

</head>

<body>
	<!-- Menu -->
	<div class="menu">
		<a href="Projects" class="projects">
			<svg><use xlink:href="assets/images/sprite.svg#briefcase"/></svg>
			<span>Projects</span>
		</a>
		<a href="Blog" class="blog">
			<svg><use xlink:href="assets/images/sprite.svg#diary"/></svg>
			<span>Blog</span>
		</a>
		<a href="Contact" class="contact">
			<svg><use xlink:href="assets/images/sprite.svg#user"/></svg>
			<span>Contact</span>
		</a>
		<div class="hamburger">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>

	<!-- Pages -->
	<section class="page" <?php if (!$page) { ?>style="display:none"<?php } ?>>
		<?php if ($page) include "php/" . strtolower($page) . ".php"; ?>
	</section>

	<!-- Intro -->
	<!-- <section class="intro">
		<div>
		<img src="assets/images/logo.png">
		<h1>Francois-Xavier's</h1>
		<h2>Epic Quest</h2>
		<p>Click to start</p>
		</div>
	</section> -->

	<!-- Game -->
	<section class="game" <?php if ($page) { echo 'style="display:none"'; } ?>>
		<div>
			<div>
				<div class="embed">
					<div id="cr-stage" class="stage"></div>
				</div>
			</div>
		</div>
	</section>

	<!-- Chat -->
	<div class="chat-button empty">
		<svg><use xlink:href="assets/images/sprite.svg#people"></use></svg>
		<span class="counter"></span>
	</div>
	<div class="chat">
		<div>
			<a href="#" class="close-button"></a>
			<div class="members"></div>
			<div class="chat-msgs"><div></div></div>
			<div>
				<textarea placeholder="Type here to chat"></textarea>
			</div>
		</div>
	</div>

	<!-- Loader -->
	<div class="loader">
		<div></div>
	</div>

	<!-- Photoswipe -->
	<?php include 'php/photoswipe.html'; ?>

	<!-- Variables -->
	<script type="text/javascript">
	var Cfg = {
		currentPage: "<?php echo $page; ?>",
		path:  "<?php url('/') ?>"
	}
		//convoId = "<?php //echo $convoId; ?>";
	</script>

	<!-- build:js js/scripts2.js -->
	<!-- Libraries -->
	<script src="bower_components/lodash/dist/lodash.min.js"></script>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/svg4everybody/dist/svg4everybody.legacy.min.js"></script>
	<script src="bower_components/tether/dist/js/tether.min.js"></script>
	<script src="bower_components/bootstrap/js/dist/util.js"></script>
	<script src="bower_components/bootstrap/js/dist/tooltip.js"></script>
	<script src="bower_components/jquery.cookie/jquery.cookie.js"></script>
	<script src="bower_components/crafty/dist/crafty.js"></script>
	<script src="bower_components/pusher-js/dist/web/pusher.js"></script>
	<!-- <script src="bower_components/webfontloader/webfontloader.js"></script> -->
	<script src="bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
	<!-- <script src="bower_components/slick-carousel/slick/slick.min.js"></script> -->
	<!-- <script src="bower_components/requirejs/require.js"></script> -->
	<!-- <script src="bower_components/photoswipe/dist/photoswipe.min.js"></script> -->
	<!-- <script src="bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script> -->
	<!-- <script src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script> -->

	<!-- Scripts -->
	<script src="js/widgets/scrollspy.js"></script>
	<script src="js/widgets/slick.js"></script>
	<script src="js/widgets/chat.js"></script>
	<script src="js/astar.js"></script>
	<script src="js/level.js"></script>
	<script src="js/util.js"></script>
	<script src="js/questmark.js"></script>
	<script src="js/character.js"></script>
	<script src="js/dialog.js"></script>
	<script src="js/audiosource.js"></script>
	<script src="js/cursor.js"></script>
	<script src="js/tile.js"></script>
	<script src="js/house.js"></script>
	<script src="js/game.js"></script>
	<script src="js/net.js"></script>
	<script src="js/app.js"></script>
	<!-- endbuild -->

	<!-- Google analytics -->
	<!-- <script>
	window.ga = window.ga || function() {
		(ga.q = ga.q || []).push(arguments)
	};
	ga.l = +new Date;
	ga('create', 'UA-12224039-1', 'auto');
	ga('send', 'pageview');
	</script> -->
	<!-- <script async defer src='https://www.google-analytics.com/analytics.js'></script> -->

	<!-- Google Knowledge Graph -->
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "Person",
		"name": "Francois-Xavier Aeberhard",
		"url": "http://red-agent.com",
		"sameAs": ["https://plus.google.com/+FrancoisXavierAeberhardRed", "https://www.youtube.com/c/FrancoisXavierAeberhardRed",	"http://www.linkedin.com/in/francoisxavieraeberhard"]
	}
	</script>

	</body>

</html>
