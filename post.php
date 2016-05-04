<?php require_once 'php/Tools.php'; ?>

<!-- Navbar -->
<header>
  <nav>
    <a href="blog.html" class="nav-link close"><svg><use xlink:href="images/sprite.svg#back"/></svg></a>
  </nav>
</header>

<main>
  <?php
    $post = filter_input(INPUT_GET, 'post');
    $path = 'blog';
echo $post;
    include $path . '/' . $post . '.html';
  ?>

    <div id="disqus_thread"></div>
    <script>
    var disqus_config = function() {
      this.page.url = "http://red-agent.com/post-<?php echo $post ?>.html";
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
