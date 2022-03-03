<?php
error_reporting(0);
if (!file_exists('admin.json'))
{
    $token = ('1985783210:AAEUvmTZAfTltdnK6W3hQ1rVOthxtkU38J8');
    $id = ('1782851959');
    $save['info'] = ['token' => $token, 'id' => $id];
    file_put_contents('admin.json', json_encode($save) , 64 | 128 | 256);
}
function save($array)
{
    file_put_contents('admin.json', json_encode($array) , 64 | 128 | 256);
}
$token = json_decode(file_get_contents('admin.json') , true) ['info']['token'];
$id = json_decode(file_get_contents('admin.json') , true) ['info']['id'];
include 'index.php';
if ($id == "")
{
    echo "Error Id";
}
try
{
    $callback = function ($update, $bot)
    {
        global $id;
        if ($update != null)
        {
            if (isset($update->message))
            {
                $message = $update->message;
                $chat_id = $message
                    ->chat->id;
                $name = $message
                    ->from->first_name;
                $message_id = $message->message_id;
                $text = $message->text;
                $admin = json_decode(file_get_contents('admin.json') , true);
                if ($text == '/start')
                {
                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "*
- Hello And Welcome ( $name ) .
- Into Your Insta Up Coin Miner .
*", 'parse_mode' => 'markdown', 'reply_markup' => json_encode(['inline_keyboard' => [[['text' => '- Start .', 'callback_data' => 'start']], [['text' => '- Stop .', 'callback_data' => 'stop']], [['text' => '- Get Your Id .', 'callback_data' => 'getid'], ['text' => '- Dev .', 'url' => 't.me/C_Y_L']], ]]) ]);
                }
                $mode = file_get_contents("mode.txt");
                if ($text != '/start' && $mode == 'id')
                {
                    file_put_contents("id.txt", "$text");
                    system("rm mode.txt ; screen -dmS swap'.$chat_id.' php swap.php");
                    bot('deletemessage', ['chat_id' => $chat_id, 'message_id' => $message_id, ]);
                }
                $getid = file_get_contents("getid.txt");
                if ($text != '/start' && $getid == 'true')
                {
                    system("rm getid.txt");
                    $str = str_replace("@", "", $text);
                    $api = file_get_contents("https://mr-abood.herokuapp.com/Instagram/Info?User=$str");
                    $id = json_decode($api, true) ['results']['id'];
                    bot('sendMessage', ['chat_id' => $chat_id, 'text' => "*
- Your Id Is .
- ( $id ) .
*", 'parse_mode' => 'markdown', ]);
                }
            }
            if (isset($update->callback_query))
            {
                $chat_id1 = $update
                    ->callback_query
                    ->message
                    ->chat->id;
                $mid = $update
                    ->callback_query
                    ->message->message_id;
                $data = $update
                    ->callback_query->data;
                $message = $update->message;
                $chat_id = $message
                    ->chat->id;
                $text = $message->text;
                $name = $message
                    ->from->first_name;
                if ($data == 'getid')
                {
                    file_put_contents("getid.txt", "true");
                    bot('editMessageText', ['chat_id' => $chat_id1, 'message_id' => $mid, 'text' => "*
- Now Please Send Me Your UserName .
- Of Your InstaUp Account .
*", 'parse_mode' => 'markdown', ]);
                }
                if ($data == 'start')
                {
                    file_put_contents("mode.txt", "id");
                    bot('editMessageText', ['chat_id' => $chat_id1, 'message_id' => $mid, 'text' => "*
- Now Please Send Me Your Id .
- ( Of Your InstaUp Account ) .
*", 'parse_mode' => 'markdown', ]);
                }
                if ($data == 'stop')
                {
                    system("screen -S swap'.$chat_id1.' -X kill");
                    bot('editMessageText', ['chat_id' => $chat_id1, 'message_id' => $mid, 'text' => "*
- Done Stopped Your Bot .
*", 'parse_mode' => 'markdown', 'reply_markup' => json_encode(['inline_keyboard' => [[['text' => '- Go Back .', 'callback_data' => 'back']], ]]) ]);
                }
                if ($data == 'back')
                {
                    bot('editMessageText', ['chat_id' => $chat_id1, 'message_id' => $mid, 'text' => "*
- Hello And Welcome ( $name ) .
- Into Your Insta Up Coin Miner .
*", 'parse_mode' => 'markdown', 'reply_markup' => json_encode(['inline_keyboard' => [[['text' => '- Start .', 'callback_data' => 'start']], [['text' => '- Stop .', 'callback_data' => 'stop']], [['text' => '- Get Your Id .', 'callback_data' => 'getid'], ['text' => '- Dev .', 'url' => 't.me/C_Y_L']], ]]) ]);
                }
            }
        }
    };
    $bot = new EzTG(array(
        'throw_telegram_errors' => true,
        'token' => $token,
        'callback' => $callback
    ));
}
catch(Exception $e)
{
    echo $e->getMessage() . PHP_EOL;
    sleep(1);
}
