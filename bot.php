<?php
file_put_contents(__DIR__ . "/" . date('Y-m-d') . ".log", date(DATE_ISO8601) . " :: ", FILE_APPEND);

$access_token = 'DBUa8Nw4ulhAg1FuFf6aPtULPidvXFg7xH5gehgkIwSUkrzelRRgkZ2h+Y66Qy1byiByGgSLTgLYL3vT6MECxHrkLHZETxL4hoPZ6PwM5k62UnfrWorMpmvmozdxzGDuDZUvWfPvOWolWSday7dtIgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
file_put_contents(__DIR__ . "/" . date('Y-m-d') . ".log", $content . " -> " . PHP_EOL, FILE_APPEND);			

// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];

			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
			file_put_contents(__DIR__ . "/" . date('Y-m-d') . ".log", $result . PHP_EOL, FILE_APPEND);			
		}
	}
}

echo "OK ..";
