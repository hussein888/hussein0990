<?php 

ob_start();

$API_KEY = '536814377:AAHr0KIPeprkA3c-deKFGugUrYPA2XH05fA';
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text; 
$textmessage = isset($update->message->text)?$update->message->text:'';
$chat_id = $message->chat->id;
$id = $message->from->id;

if ($text == "/start") {
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"ارسل اسمك بلعربي او انكلش",
'parse_mode'=>'markdown'
    ]);
}

if ($text != "/start") {
  $get = file_get_contents("https://rueslinks.000webhostapp.com/font.php?text=$text");
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"$get", 
'parse_mode'=>'markdown'
    ]);
}