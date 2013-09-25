<?php

require_once 'Pusher.php';

define("APP_KEY", "9d4eb6ada84f3af3c77f");
define("APP_SECRET", "c0ecc6aa74215d03cc22");
define("APP_ID", "10827");

//if (is_user_logged_in()) {

$pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
//echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
//echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], "1");
$date = new DateTime();
echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], "" . $date->getTimestamp());

//} else {
//    header('', true, 403);
//    echo "Forbidden";
//}
?>