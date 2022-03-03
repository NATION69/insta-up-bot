<?php
$token = json_decode(file_get_contents('admin.json'),true)['info']['token'];
$id = json_decode(file_get_contents('admin.json'),true)['info']['id'];
include 'index.php';
$admin = json_decode(file_get_contents('admin.json'),true);
$swapped = file_get_contents("swapped");
$checked = file_get_contents("checked");
$bad = file_get_contents("bad");
bot('sendMessage',[
'chat_id'=>$MohanadCoinMiner,
'text'=>"
- SomeOne Got A New Coins !! .
- Tries : $checked .
- Swapped Times : $swapped .
- Did Not Swap Time : $bad .
- Dev : @C_Y_L - @Extracttt .
",
]);
