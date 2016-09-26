<?php 

http_response_code(200); echo "{}";

//webhook set at @ xyz.ch/../telegram/receiverbot.php
$botToken = "get botToken from @botfather";
$website = "https://api.telegram.org/bot".$botToken;

$rawContent = file_get_contents("php://input");
$rawContentArray = json_decode($rawContent, true);
$chatId = "";
$text = "";

foreach ($rawContentArray as $key => $value) {
	if($key === "message"){
		foreach ($value as $messagekey => $messagevalue) {
			if($messagekey === "text"){
				$text = $messagevalue;
			}
			
			if($messagekey === "chat"){
				foreach ($messagevalue as $chatkey => $chatvalue) {
					if($chatkey === "id"){
						$chatId = $chatvalue;
					}
				}
			}
		}
	}
}

switch ($text){
	case "/startrequest@BoysBoysBoysImageReceiverBot":
	case "/startrequest":
		file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=/newpoll");
		break;
	case "/why@BoysBoysBoysImageReceiverBot":	
	case "/why":
		file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=Insert reason");
		break;
	default:
		file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=What do you mean?");
		break;
}

?>