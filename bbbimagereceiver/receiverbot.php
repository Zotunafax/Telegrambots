<?php 

http_response_code(200); echo "{}";

//setWebhook @ xyz.ch/telegram/receiverbot.php first
//do not forget to reset Webhook before quitting work
$botToken = "get token from @botfather";
$website = "https://api.telegram.org/bot".$botToken;

$rawContent = file_get_contents("php://input");
$rawContentArray = json_decode($rawContent, TRUE);
$result = $rawContentArray["result"];


$chatId = $result["message"]["chat"]["id"];
$text = $result["message"]["text"];

$sentences = ["Wow I can speak. Isn't that amazing?","Transfering data to NSA now...","Wait, this isn't Whatsapp?","What do you mean I'm not human???"];

$chosensentence = array_rand($sentences, 1);

if($text === "/startrequest" || $text === "/why") {
	file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".$sentences[$chosensentence]);
} else {
	file_get_contents($website."/sendmessage?chat_id=11405325&text=".$rawContent);
}

//file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=/Images");

?>