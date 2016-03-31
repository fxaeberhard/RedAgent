<?php
require_once 'php/Tools.php';

$op = filter_input(INPUT_POST, 'op');

if ($op === "comment") {
    $file = filter_input(INPUT_POST, 'file');
    $comment = filter_input(INPUT_POST, 'comment');
    $f = fopen($file, "a+");
    file_put_contents($file, "<aside class='blog-comment redagent-page-text'><em>" . date("d F y") . "</em><br />$comment</aside>", FILE_APPEND);
    fclose($f);
    include $file;
    die();
}
?>

  <!-- Navbar -->
  <header>
    <nav>
      <a href="/" class="nav-link close"><svg><use xlink:href="images/sprite.svg#back"/></svg></a>
      <div class="collapse navbar-toggleable" id="navbar-header">
        <ul>
          <li><a href="#songbook" class="active nav-link">2015</a></li>
          <li><a href="#arthur" class="active nav-link">2014</a></li>
          <li><a href="#mariagelaurent" class="nav-link">2013</a></li>
        </ul>
      </div>
      <form class="form-inline pull-xs-right hidden-md-down">
        <svg><use xlink:href="images/sprite.svg#search"/></svg>
        <input class="form-control" type="text" placeholder="Search" />
      </form>
      <!-- <button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">&#9776;</button> -->
    </nav>
  </header>
  <main>
    <?php
    $path = "blog/";
    $files = listdir($path);
    sort($files, SORT_LOCALE_STRING);
    $files = array_reverse($files);
    foreach ($files as $entry) {
        ?>
      <!-- <div class="redagent-article blog-post" data-post="<?php echo $entry ?>"> -->

      <!-- <div> -->
      <?php include $entry; ?>
      <!-- </div> -->
      <!--  <article>
        <div class="blog-addcomment redagent-page-text">
          <textarea rows="2" placeholder="My comment"></textarea>
        </div>
      </article> -->
      <!-- </div> -->
      <?php 
    } ?>

      <?php footer() ?>

  </main>
