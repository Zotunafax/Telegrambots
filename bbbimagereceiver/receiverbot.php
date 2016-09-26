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

if($text === "/startrequest" || $text === "/why") {
	file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=/Images");
} else {
	file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=What do you mean?");
}

?>