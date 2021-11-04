<?php

function sendTelegram($chat_id, $token, $text) {
	// following ones are optional, so could be set as null
	$disable_web_page_preview = null;
	$reply_to_message_id = null;
	$reply_markup = null;

	$data = array(
					'chat_id' => $chat_id,
					'text' => $text,
					'parse_mode' => 'HTML',
					'disable_web_page_preview' => urlencode($disable_web_page_preview),
					'reply_to_message_id' => urlencode($reply_to_message_id),
					'reply_markup' => urlencode($reply_markup)
			);

	$url = "https://api.telegram.org/bot".$token."/sendMessage";

	//  open connection
	$ch = curl_init();
	//  set the url
	curl_setopt($ch, CURLOPT_URL, $url);
	//  number of POST vars
	curl_setopt($ch, CURLOPT_POST, count($data));
	//  POST data
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	//  To display result of curl
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//  execute post
	$result = curl_exec($ch);
	echo $result;
	//  close connection
	curl_close($ch);
}

$token = $_ENV['TELEGRAM_TOKEN'];
$chat_id = $_ENV['TELEGRAM_CLIENT_ID'];
sendTelegram($chat_id, $token, 'red-agent.com contact form sent' );
sendTelegram($chat_id, $token, $_REQUEST["msg"]);
