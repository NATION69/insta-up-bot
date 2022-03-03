<?php
error_reporting(0);
if(!file_exists('admin.json')){
$token = ('1985783210:AAGYuA17b5D506KmjkdnfwSRYmurClsh7qI');
$id = ('1782851959');
$save['info'] = [
'token'=>$token,
'id'=>$id
];
file_put_contents('admin.json',json_encode($save),64|128|256);
}
function save($array){
file_put_contents('admin.json',json_encode($array),64|128|256);
}
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
if($id == ""){
echo "Error Id";
}
try {
 $callback = function ($update, $bot) {
  global $id;
  if($update != null){
   if(isset($update->message)){
    $message = $update->message;
    $chat_id = $message->chat->id;   
    $name = $message->from->first_name;
    $message_id = $message->message_id;
    $text = $message->text;
$admin = json_decode(file_get_contents('admin.json'),true);
if($text == '/start' && $chat_id == $admin['info']['id']){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
- Hello And Welcome ( $name ) ,
- Into Your Insta Up Coin Miner Bot .
- Please Enjoy Our Product .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Start  The Bot .','callback_data'=>'Start'],['text'=>'- Stop The Bot .','callback_data'=>'Stop']],
[['text'=>'- Bot Status .','callback_data'=>'status'],['text'=>'- Get Id .','callback_data'=>'getid']],
[['text'=>'- Kill All Process .','callback_data'=>'delall']],
[['text'=>'- Dev .','url'=>'t.me/C_Y_L']],
]
])
]);
}
if($text != '/start' && file_get_contents("sendid") == 'true'){
$sleep = file_get_contents("sleep");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
- Done Set Your Sleep : $sleep ( In Secends ) .
- And Done Set Your Id : $text .
- Do You Want To Start The Bot Or Not .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Start The Bot .','callback_data'=>'starts'],['text'=>'- Go Back .','callback_data'=>'back']],
[['text'=>'- Change Id ? .','callback_data'=>'resetid']],
]
])
]);
file_put_contents("instaid","$text");
unlink("sendid");
}
if($text != '/start' && file_get_contents("sendsleep") == 'true'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
- Now Please Send Me Your Insta Up Id .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'back']],
]
])
]);
file_put_contents("sleep","$text");
file_put_contents("sendid","true");
unlink("sendsleep");
}
$getid = file_get_contents("getid");
if($text != '/start' && $getid == 'true'){
$str = str_replace("@", "", $text);
$api = file_get_contents("http://178.62.206.135/getid.php/?user=$str");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text' => "*
- Your Id Is .
- ( $api ) .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'bacck']],
]
])
]);
unlink("getid");
}
}
}
if(isset($update->callback_query)) {
    $chat_id1 = $update->callback_query->message->chat->id;
    $mid = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text;
    $name = $update->callback_query->from->first_name;
if($data == 'Start'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Select Your Sleep Count .
- We Suggest 5 Min .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- 3 Min .','callback_data'=>'3m'],['text'=>'- 5 Min .','callback_data'=>'5m']],
[['text'=>'- Custom Sleep .','callback_data'=>'cs'],['text'=>'- 7 Min .','callback_data'=>'7m']],
[['text'=>'- Go Back .','callback_data'=>'bacck']],
]
])
]);
}
if($data == '3m'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Your Insta Up Id .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'back']],
]
])
]);
file_put_contents('sleep',"180");
file_put_contents("sendid","true");
}
if($data == '5m'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Your Insta Up Id .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'back']],
]
])
]);
file_put_contents('sleep',"300");
file_put_contents("sendid","true");
}
if($data == '7m'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Your Insta Up Id .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'back']],
]
])
]);
file_put_contents('sleep',"420");
file_put_contents("sendid","true");
}
if($data == 'cs'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Sleep Count ( In Secends ) .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'back']],
]
])
]);
file_put_contents("sendsleep","true");
}
if($data == 'resetid'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Your Insta Up Id .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Go Back .','callback_data'=>'back']],
]
])
]);
file_put_contents("sendid","true");
}
if($data == 'back'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Hello And Welcome ( $name ) ,
- Into Your Insta Up Coin Miner Bot .
- Please Enjoy Our Product .
*",
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Start  The Bot .','callback_data'=>'Start'],['text'=>'- Stop The Bot .','callback_data'=>'Stop']],
[['text'=>'- Bot Status .','callback_data'=>'status'],['text'=>'- Get Id .','callback_data'=>'getid']],
[['text'=>'- Kill All Process .','callback_data'=>'delall']],
[['text'=>'- Dev .','url'=>'t.me/C_Y_L']],
]
])
]);
unlink("instaid");
unlink("sendid");
unlink("getid");
unlink("sleep");
unlink("sendsleep");
}
if($data == 'starts'){
$screens = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),1,7);    
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Done Started The Bot , Screen : $screens .
*",
'parse_mode'=>'markdown',
]);
system('screen -dmS n'.$screens.' php check.php');
file_put_contents('screens',$screens."\n",FILE_APPEND);
}
if($data == 'Stop'){
$ex = explode("\n",file_get_contents('screens'));
for($i=0;$i<count($ex);$i++){
$keyboard['inline_keyboard'][] = [['text'=>$ex[$i],'callback_data'=>'kill#'.$ex[$i]]];
}
$keyboard['inline_keyboard'][] = [['text'=>'- Go Back','callback_data'=>'back']];
$keys = json_encode($keyboard);
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
- Choose The Screen You Want To Delete
",
'reply_markup'=>$keys,
]);
}
$exxp = explode('#',$data);
if($exxp[0] == 'kill'){
$slpq = str_replace($exxp[1],'',file_get_contents('screens'));
file_put_contents('screens',$slpq);
system('screen -S n'.$exxp[1].' -X kill');
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
- Done Stopped Screen Succsesfully , Screen : *{$exxp[1]}*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Go Back .",'callback_data'=>'bacck']],
]
])
]);
}
if($data == 'status'){
$scrns = file_get_contents('screens');
if(empty($scrns) or $scrns == null or $scrns == "\n"){
$stats = '- Stopped .';
$scrn = 0;
} else {
$stats = '- Working .';
$plat = explode("\n",file_get_contents('screens'));
$scrn = count($plat)-1;
}
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"
- Status : *{$stats}* .
- Screens Counter *{$scrn}* .
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Go Back .",'callback_data'=>'bacck']],
]
])
]);
}
if($data == 'bacck'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Hello And Welcome ( $name ) ,
- Into Your Insta Up Coin Miner Bot .
- Please Enjoy Our Product .
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'- Start  The Bot .','callback_data'=>'Start'],['text'=>'- Stop The Bot .','callback_data'=>'Stop']],
[['text'=>'- Bot Status .','callback_data'=>'status'],['text'=>'- Get Id .','callback_data'=>'getid']],
[['text'=>'- Kill All Process .','callback_data'=>'delall']],
[['text'=>'- Dev .','url'=>'t.me/C_Y_L']],
]
])
]);
} 
if($data == 'getid'){
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Now Please Send Me Your Username .
- By : *{@C_Y_L}* .
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Go Back .",'callback_data'=>'back']],
]
])
]);
file_put_contents("getid","true");
}
if($data == 'delall'){
$get = file_get_contents("screens");
$explode = explode("\n", $get);
for($c=0; $c<count($explode); $c++) { 
$scd = $explode[$c];
system("screen -S '.$scd.' -X kill");
bot('editMessageText',[
'chat_id'=>$chat_id1,
'message_id'=>$mid,
'text'=>"*
- Done Deleted All Of Them .
*",
'parse_mode'=>"markdown",
]);
unlink("screens");
}
}
      }
    };
         $bot = new EzTG(array('throw_telegram_errors'=>true,'token' => $token, 'callback' => $callback));
  }
    catch(Exception $e){
 echo $e->getMessage().PHP_EOL;
 sleep(1);
}

