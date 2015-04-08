<?php
require_once 'php/Tools.php';

$op = filter_input(INPUT_POST, 'op');

if ($op === "comment") {
    $file = filter_input(INPUT_POST, 'file');
    $comment = filter_input(INPUT_POST, 'comment');
    $f = fopen($file, "a+");
    file_put_contents($file, "<div class='blog-comment'><em>" . date("d F y") . "</em><br />$comment</div>", FILE_APPEND);
    fclose($f);
    include $file;
    die();
}
?>
<div role="main" class="cf page-blog">

    <div style="height:1em">.</div>

    <?php
    $path = "blog/";
    $files = listdir($path);
    sort($files, SORT_LOCALE_STRING);
    $files = array_reverse($files);
    foreach ($files as $entry) {
        ?>
        <div class="redagent-article blog-post" data-post="<?php echo $entry ?>">

            <div><?php include $entry; ?></div>

            <div class="blog-addcomment">
                <textarea rows="2"  placeholder="My comment"></textarea>
            </div>

        </div>
    <?php } ?>

</div>

<footer class="cf" style="max-width:100%; margin: 5em 0 1em;">
    <?php include 'php/footer.php'; ?>
</footer>
