<?php 

http_response_code(200); echo "{}";

$botToken = "insert token here (request from @Botfather";
$website = "https://api.telegram.org/bot".$botToken;

$content = file_get_contents($website."/getupdates");
$contentArray = json_decode($content, TRUE);
$message = $contentArray["message"];


$chatId = $contentArray["chat"]["id"];
$text = $message["text"];

$sentences = ["Wow I can speak. Isn't that amazing?","Transfering data to NSA now...","Wait, this isn't Whatsapp?","What do you mean I'm not human???"];

$chosensentence = array_rand($sentences, 1);

if($text === "/startRequest" || $text === "/giveMeSomething") {
	file_get_contents($website."/sendmessage?chat_id=110405325&text=".$sentences[$chosensentence]);
} else {
	print_r($sentences[$chosensentence]);
	file_get_contents($website."/sendmessage?chat_id=11405325&text=".$content);
}

//file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=/Images");

?>