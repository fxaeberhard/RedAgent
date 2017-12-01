<?php

global $pages;

$pages = array(
    "" => array(
        "title" => "Red Agent - Francois-Xavier Aeberhard portfolio",
        "description" => "My name is Francois-Xavier Aeberhard, I'm an user experience engineer and this is my portfolio."),
    "Projects" => array(
        "title" => "Francois-Xavier Aeberhard Projects",
        "description" => "Discover my work: Wallogram, Programming game, Michael Jackson the experiene and much more."),
    "Contact" => array(
        "title" => "Contact Francois-Xavier Aeberhard",
        "description" => "Francois-Xavier Aeberhard, Level 110 User experience engineer"),
    "Blog" => array(
        "title" => "Francois-Xavier Aeberhard Blog",
        "description" => "Drawings, movies or small games, this is what i do in my free time and I want to keep a trace of."),
    "Post" => array(
        "description" => "Francois-Xavier Aeberhard Blog"));

function title($page = '') {
    if ($page == 'Post') {
        $post = filter_input(INPUT_GET, 'post');
        echo ucfirst(preg_replace('/^[0-9]+/', '',str_replace('-', ' ', $post)));
    } else {
        global $pages;
        echo $pages[$page]["title"];
    }
}

function description($page = "") {
    global $pages;
    echo $pages[$page]["description"];
}

function footer($page = '') {
    global $pages;
    echo '<footer>';
    echo '<h1>François-Xavier Aeberhard Portfolio</h1>';
    $links = ['Blog','Contact', 'Projects'];
    foreach ($links as $p ) {
        if ($page == $p) {
            echo '<a class="current">'.ucfirst($p)."</a>";
        } else {
            echo '<a href="'.$p.'">'.ucfirst($p)."</a>";
        }
    }
    echo '</footer>';
}

$cookie_name = 'Program_O_JSON_GUI';
function get_convo_id() {
    global $cookie_name;
    session_name($cookie_name);
    session_start();
    $convo_id = session_id();
    session_destroy();
    setcookie($cookie_name, $convo_id);
    return $convo_id;
}

function lazypicture($src, $options = "") {
    $options = 'sa=jpg&nu&' . $options;
    echo '<img class="img-fluid" data-lazy-srcset="i/'. $src . '?w=526&' . $options . ', i/'. $src . '?w=789&' . $options . ' 1.5x, i/'. $src . '?w=1052&' . $options . ' 2x" data-lazy-src="i/'. $src . '?w=526&' . $options . '" />';
}

function gallery($dir, $options = "", $lazy = true) {
    $files = glob(__DIR__  . "/../assets/images/$dir/*.{jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG}", GLOB_BRACE);
    sort($files, SORT_LOCALE_STRING);
    echo '<div class="slick" itemscope itemtype="http://schema.org/ImageGallery">';
    $i = 0;
    $options = 'sa=jpg&' . $options;
    foreach ($files as $entry) {
        $src = str_replace(__DIR__ .'/../assets/images/', '', $entry);
        $size = getimagesize($entry);
        echo '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
        echo '<a href="i/'.$src.'" data-gallery="' . $dir . '" itemprop="contentUrl" data-size="'. $size[0] . 'x' . $size[1] .'" data-index="' . $i . '">';

        if (!$lazy && $i == 0) {
            echo '<img class="img-fluid center-block" src="i/'. $src . '?w=526&' . $options . '" srcset="i/'. $src . '?w=526&' . $options . ', i/'. $src . '?w=789&' . $options . ' 1.5x, i/'. $src . '?w=1052&' . $options . ' 2x"/>';
        }else {
            echo '<img class="img-fluid center-block" data-lazy-slsrcset="i/'. $src . '?w=526&' . $options . ', i/'. $src . '?w=789&' . $options . ' 1.5x, i/'. $src . '?w=1052&' . $options . ' 2x" data-lazy="i/'. $src . '?w=526&' . $options . '" />';
        }
        echo '</a></figure>';
        $i = $i + 1;
    }
    echo '</div>';
}

function hiddenGallery($dir) {
    $files = glob(__DIR__ ."/../assets/images/$dir/*.{jpg,gif,png,jpeg,JPG,GIF,PNG,JPEG}", GLOB_BRACE);
    sort($files, SORT_LOCALE_STRING);
    foreach ($files as $entry) {
      $s = getimagesize($entry);
      $src = str_replace(__DIR__ .'/../assets/images/', '', $entry);
      echo '<a data-gallery="'. $dir . '" href="i/' . $src . '" data-size="'. $s[0] . 'x' . $s[1] .'" class="hide"></a>';
    }
}

function path() {
	  if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1")
    	return '/edsa-work/RedAgent';
		else
			return '';
}

function url($path) {
    echo path() . $path;
}

// function renderBootstrapGallery($dir, $options = "") {
//     $path = "assets/images/projects/" . $dir . "/";
//     $files = listdir($path);
//     sort($files, SORT_LOCALE_STRING);
//     echo '<div id="'.$dir.'Carousel" class="carousel slide" data-ride="carousel">';
//     echo '<ol class="carousel-indicators">';
//     $i = 0;
//     foreach ($files as $entry) {
//         // echo '<div><a class="fancybox" rel="' . $dir . '" href="' . $entry . '" data-thumbnail="imgpp/' . $entry . '?h=80&w=80&crop-to-fit&sa=jpg">'
//         // . '<img data-lazy="imgpp/' . $entry . '?w=420&sa=jpg&' . $options . '"/>'
//         // . '<div class="play-button"></div>'
//         // . '</a></div>';
//         echo '<li data-target="#'.$dir.'Carousel" data-slide-to="' . $i . '" ' . ($i == 0 ? ' class="active"' : '') . '></li>';
//         $i++;
//     }
//     echo '</ol>';

//     echo '<div class="carousel-inner" role="listbox">';
//     $i = 0;
//     foreach ($files as $entry) {
//         echo '<div class="carousel-item ' . ($i == 0 ? ' active' : '') . '">';
//         // echo '<img src="imgpp/' . $entry . '?h=80&w=80&crop-to-fit&sa=jpg" alt="...">';
//         echo '<img class="center-block" src="'. $entry . '" alt="...">';
//         echo '<div class="carousel-caption"></div>';
//         echo '</div>';
//         $i++;
//     }
//     echo '</div>';

//     echo '<a class="left carousel-control" href="#'.$dir.'Carousel" role="button" data-slide="prev">';
//     echo ' <span class="icon-prev" aria-hidden="true"></span>';
//     echo '<span class="sr-only">Previous</span>';
//     echo '</a>';
//     echo '<a class="right carousel-control" href="#'.$dir.'Carousel" role="button" data-slide="next">';
//     echo '<span class="icon-prev" aria-hidden="true"></span>';
//     echo '<span class="sr-only">Next</span>';
//     echo '</a>';
//     echo '</div>';
// }
