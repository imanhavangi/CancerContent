<?
$input = file_get_contents('php://input');
$update = json_decode($input);
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$token = '5263621778:AAEMxIktCgfExbYGmmltFHgZ-FjspX5PBcY';
file_get_contents("https://api.telegram.org/bot$token/sendVideo?chat_id=$chat_id&video=BAACAgQAAxkBAANzYjY651brObumcWc9NOhYFRiR-TYAAgsNAAKRSnlRUOBdvH_1qewjBA&caption=@Cancer_Content");