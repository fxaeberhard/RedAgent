<?php

require_once '../vendor/pusher/pusher-php-server/lib/Pusher.php';

define("APP_KEY", "52b7c53f33754e278bd6");
define("APP_SECRET", "551ccd900c3d322346ee");
define("APP_ID", "309220");

//if (is_user_logged_in()) {

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
//echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
//echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], "1");
$date = new DateTime();
echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], "" . $date->format('U'), array('name' => "Guest"));
//} else {
//    header('', true, 403);
//    echo "Forbidden";
//}
?>