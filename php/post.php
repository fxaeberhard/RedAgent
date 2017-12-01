<?php require_once 'app.php'; ?>

<!-- Navbar -->
<a href="Blog" class="nav-link close"><svg><use xlink:href="assets/images/sprite.svg#back"/></svg></a>

<!-- header>
  <nav></nav>
</header> -->

<main>
  <?php
    $post = filter_input(INPUT_GET, 'post');
    $path = __DIR__ . '/blog';
		$p = $path . '/' . $post . '.html';
		if (!file_exists($p)) {
  		header('HTTP/1.0 404 Not Found');
			echo "404 Page not found.";
			die();
		}
    include $p;
  ?>

    <div id="disqus_thread"></div>
    <script>
    var disqus_config = function() {
      this.page.url = "https://red-agent.com/post-<?php echo $post ?>";
      this.page.identifier = "<?php echo $post ?>";
    };
    (function() {
      var d = document,
        s = d.createElement('script');
      s.src = '//redagent.disqus.com/embed.js';
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

    <?php footer('blog'); ?>

</main>
