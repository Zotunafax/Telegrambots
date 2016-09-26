<?php 

http_response_code(200); echo "{}";

//setwebhook @ xyz.ch/../telegram/circle.php
$botToken = "get botToken from @botFather";
$website = "https://api.telegram.org/bot".$botToken;

$rawContent = file_get_contents("php://input");
$rawContentArray = json_decode($rawContent, true);
$chatId = "";
$messageId = "";
$text = "";
$answers = array("I am not sure what to answer... Please forgive me.",
				"Maybe, I lack the experience to answer that question.",
				"Sure, why not?",
				"That is a weird question and I choose not to answer it.",
				"Yes.",
				"No.",
				"Why do you ask me? Can't you decide that for yourself?",
				"I don't really care. Just do something.",
				"I hate making decisions. Please stop asking me.",
				"I am a butler, not a magic ball you can shake and get answers from.",
				"I can't explain it but this question makes me sad. Therefore I won't answer it.",
				"Look, every answer is right. Just think of good reasons for both options.");

foreach ($rawContentArray as $key => $value) {
	if($key === "message"){
		foreach ($value as $messagekey => $messagevalue) {
			if($messagekey === "text"){
				$text = $messagevalue;
			}
			if($messagekey === "messageid"){
				$messageId = $messagevalue;
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

switch($text){
	case "/start":
	case "/start@InnerCircleBot":
		file_get_contents($website."/sendmessage?chat_id=".$chatId."&reply_to_message=".$messageId."&text=Thank you for starting @InnerCircleBot. My name is Mr. Butler. I hope I can help you with your problems.");
		die("end of start");
		break;
	case "/about":
	case "/about@InnerCircleBot":
		file_get_contents($website."/sendmessage?chat_id=".$chatId."&reply_to_message=".$messageId."&text=My name is Mr. Butler. You can ask me questions and I try to answer them. Please don't be mad at me, I am still learning.");
		die("end of about");
		break;
	case "/question":
	case "/question@InnerCircleBot":
		file_get_contents($website."/sendmessage?chat_id=".$chatId."&reply_to_message=".$messageId."&text=Please ask me a question in this format: Mr. Butler, [insert question here]? y/n. I can only answer yes / no questions at this moment.");
		die("end of question");
		break;
}

if($text == ""){
	die("System output");
} else{
	if (strpos($text, "Mr. Butler") !== false){
		if (strpos($text, "y/n") !== false OR strpos($text, "Y/N") !== false){
			$chosenanswer = $answers[array_rand($answers)];
			file_get_contents($website."/sendmessage?chat_id=".$chatId."&reply_to_message=".$messageId."&text=".$chosenanswer);
		}
		if (strpos($text, "Thank you") !== false){
			file_get_contents($website."/sendmessage?chat_id=".$chatId."&reply_to_message=".$messageId."&text=You are welcome.");
		}
	}
}

?>