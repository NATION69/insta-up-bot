<?php
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
$admin = json_decode(file_get_contents('admin.json'),true);
$checked = 0;
$hit = 0;
$bad = 0;
$error = 0;
$edit = bot('sendMessage',[
'chat_id'=>$id,
'text'=>"
- Go To Sleep .
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1'],['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
$instaid = file_get_contents("instaid");
$sleep = file_get_contents("sleep");
while(true){
$swap = swap($instaid,$sleep);
if($swap == 'true'){
file_put_contents("checked","$checked");
file_put_contents("swapped","$hit");
file_put_contents("bad","$bad");
system("php send.php");
$hit += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1'],['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
}elseif($swap == 'false'){
file_put_contents("checked","$checked");
file_put_contents("swapped","$hit");
file_put_contents("bad","$bad");
$bad += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1'],['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
}elseif($swap == 'blocked'){
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"
- Warning ⚠️ .
- - - - - 
- The Bot Have Been Stopped !! . 
- Because Your Account Have Been Blocked .
- We Are Sorry To Notify You .
- With Pleasure .
- - - - -
",
]);
exit();
} else {
$error += 1;
$checked += 1;
bot('editMessageReplyMarkup',[
'chat_id'=>$id,
'message_id'=>$edit->result->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- Tries : $checked .",'callback_data'=>'i']],
[['text'=>"- Swapped : $hit .",'callback_data'=>'i1'],['text'=>"- Didn't Swap : $bad .",'callback_data'=>'i2']],
[['text'=>"- Error : $error .",'callback_data'=>'i4']],
]
])
]);
}
}
?>
