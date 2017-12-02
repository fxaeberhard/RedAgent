<?php require_once 'app.php'; ?>

<!-- Navbar -->
<a href="/" class="nav-link close"><svg><use xlink:href="assets/images/sprite.svg#back"/></svg></a>
<header>
  <nav>
    <div class="collapse navbar-toggleable" id="navbar-header">
      <ul>
        <li><a href="#multiverse" class="active nav-link">2017</a></li>
        <li><a href="#arlette" class="nav-link">2016</a></li>
        <li><a href="#grugandgrug	" class="nav-link">2015</a></li>
        <li><a href="#arthur" class="nav-link">2014</a></li>
        <li><a href="#mariagelaurent" class="nav-link">2013</a></li>
      </ul>
    </div>
    <form class="form-inline pull-xs-right hidden-md-down">
      <svg><use xlink:href="assets/images/sprite.svg#search"/></svg>
      <input class="form-control" type="text" placeholder="Search" />
    </form>
  </nav>
</header>

<main>
  <?php
    $path = __DIR__ . '/blog/';

    $files = glob($path. '*', GLOB_BRACE);
    sort($files, SORT_LOCALE_STRING);
    $files = array_reverse($files);
    $isList = true;
    // uasort($files, function($a, $b) {
    //   return filectime($a) < filectime($b);
    // });

    foreach ($files as $f) {
      $postUrl =  'https://red-agent.com/post-' . str_replace([$path, '.html'], '', $f);
      $addon = '<a href="' . $postUrl . '#disqus_thread" class="pull-right link">0 Comments</a>';
      include $f;
    }

    footer('blog');
  ?>
</main>

<script id="dsq-count-scr" src="//redagent.disqus.com/count.js" async></script>
