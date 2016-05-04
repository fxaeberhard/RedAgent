<?php require_once 'php/Tools.php'; ?>

<!-- Navbar -->
<header>
  <nav>
    <a href="/" class="nav-link close"><svg><use xlink:href="images/sprite.svg#back"/></svg></a>
    <div class="collapse navbar-toggleable" id="navbar-header">
      <ul>
        <li><a href="#songbook" class="active nav-link">2015</a></li>
        <li><a href="#arthur" class="nav-link">2014</a></li>
        <li><a href="#mariagelaurent" class="nav-link">2013</a></li>
      </ul>
    </div>
    <form class="form-inline pull-xs-right hidden-md-down">
      <svg><use xlink:href="images/sprite.svg#search"/></svg>
      <input class="form-control" type="text" placeholder="Search" />
    </form>
  </nav>
</header>

<main>
  <?php
    $path = 'blog';
    
    $files = glob('blog/*');
    uasort($files, function($a, $b) {
      return filectime($a) < filectime($b);
    });

    foreach ($files as $f) {
      $addon = '<a href="http://red-agent.com/post-' . str_replace($path . '/', '', $f) . '#disqus_thread" class="pull-right link">0 Comments</a>';
      include $f;
    } 

    footer($page);
  ?>
</main>

<script id="dsq-count-scr" src="//redagent.disqus.com/count.js" async></script>
