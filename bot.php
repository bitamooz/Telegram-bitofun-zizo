<?php
/*
🚀 این سورس کد رو به‌صورت کاملاً رایگان از گنجینه برنامه‌نویسی بیت‌آموز دریافت کردی!  
🎯 جدیدترین سورس‌ها، آموزش‌ها و ابزارهای کاربردی رو همین الان از سایت ما دانلود کن:  
🌐 https://BitAmooz.com  

💡 دوست داری همیشه یک قدم جلوتر باشی؟  
هر روز کلی سورس رایگان، تکنیک‌های برنامه‌نویسی و نکات حرفه‌ای توی بیت‌آموز منتشر میشه!  
⏳ وقتشه که سطح کدنویسی خودتو ارتقا بدی!  
🔗 همین الان وارد سایت شو و سورس‌های بیشتری بگیر: https://BitAmooz.com  
*/
ob_start();
define('API_KEY','token'); // توکن ربات

function BitBotReq($method,$datas=[]){
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
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$textmassage = $message->text;
$Dev = 123456789; // آیدی عددی ادمین
$lock_channel = "@"; // با @
$Robot_UserName = ""; // بدون @
$messageid = $update->callback_query->message->message_id;
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$lock_channel&user_id=".$from_id));
$tch = $truechannel->result->status;
if(!file_exists("User_Data/")) mkdir("User_Data/");
if(!file_exists("User_Data/$from_id"))
{
	mkdir("User_Data/$from_id");
	file_put_contents("User_Data/$from_id/file.txt", " ");
}
if(!file_exists("Learn_Words/")) mkdir("Learn_Words/");

$user_step = file_get_contents("User_Data/$from_id/file.txt");
function SendMessage($chat_id, $text){
BitBotReq('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}
function save_file($filename, $data)
{
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
function sendAction($chat_id, $action){
BitBotReq('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
BitBotReq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}


if($textmassage=="/start"){
        sendAction($chat_id, 'typing');
	BitBotReq('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✨ *سلام عزیزم! من بیتوفان زیزو هستم* ✨

من یه ربات دوست‌داشتنی هستم که می‌تونم مثل آدم‌ها باهات صحبت کنم 😊
البته هنوز کوچیکم و کلی چیز هست که بلد نیستم... 
اما *تو می‌تونی بهم یاد بدی*! 🤩

بیا با هم این سفر جذاب رو شروع کنیم... 
روی دکمه *«بهم یاد بده»* کلیک کن تا با هم چیزای جدید یاد بگیریم! 💖",
        'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
		[
			['text'=>"لینک دعوت دوستان 🔗"], 
			['text'=>"بهم یاد بده 🌟"]
		],
		[['text'=>"نظرتو بگو 📝"]]
	]
	])]);
	
	
	}
	
		elseif($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
		            sendAction($chat_id, 'typing');
	BitBotReq('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🌈 *دوست عزیز برای ادامه لطفاً:* 🌈

1️⃣ اول تو کانال ما عضو شو 👇
   🔹 $lock_channel

2️⃣ بعد دکمه *شروع (/start)* رو دوباره بزن

اینطوری هم از ما حمایت می‌کنی هم به من کمک می‌کنی رشد کنم! 🤗",
      'parse_mode'=>'html',	
	]);
	}
	
	elseif($textmassage=="برگشت"){
        sendAction($chat_id, 'typing');
	BitBotReq('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"به صفحه اصلی برگشتیم :",
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
		['text'=>"لینک دعوت دوستان 🔗"],['text'=>"بهم یاد بده 🌟"]
	],
	[['text'=>"نظرتو بگو 📝"]],
	]
	])
	
	]);
	
	
	}elseif($textmassage=="نظرتو بگو 📝"){
                        sendAction($chat_id, 'typing');
			save_file("User_Data/$from_id/file.txt","nazar");
				BitBotReq('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"خوب حالا نظرت و بگو ببینم میخوای راجب من چی بگی😍:",
                 'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
	['text'=>"برگشت"]
	],
	]
	])
	
	]);
	
	
	}elseif($user_step=="nazar"){            
                       save_file("User_Data/$from_id/file.txt","none");
                          Forward($Dev,$chat_id,$message_id);
			BitBotReq('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"دمتگرم بابت نظری که دادی. ایشاالله تو شادی هات بهت نظر بدم حال کنی!❤️",
      'parse_mode'=>'MarkDown',
	
	]);
	
	
	}elseif($textmassage=="لینک دعوت دوستان 🔗"){
        sendAction($chat_id, 'typing');
				BitBotReq('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"ربات آوردم برات چه رباتی😄
میتونه دوست شما باشه و با شما حرف بزنه😀
میتونی بهش کلمه یاد بدی😺
میتونی بهش یاد بدی و پیش رفیقات پوزش و بدی و بگی بچمه😮
پس شروع کن🤤
https://telegram.me/$Robot_UserName?start=$from_id",
    'parse_mode'=>'html',
		]);
		}

elseif($textmassage=="بهم یاد بده 🌟"){
                        sendAction($chat_id, 'typing');
			save_file("User_Data/$from_id/file.txt","pa2");
				BitBotReq('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"خب دوست خوبم ممنون که میخوای به من صحبت کردن یاد بدی 
الان متن یا کلمه ای که میخوای وقتی میفرستی من بهش جواب بدم روبفرست :",
      'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
	['text'=>"برگشت"]
	],
	]
	])
		]);
		}elseif($user_step=="pa2"){
			save_file("User_Data/$from_id/file.txt","pa3");
			BitBotReq('sendmessage',[
			'chat_id'=>$chat_id,
			'text'=>"خب افرین حالا من باید به اون متن شما پاسخ بدم متن پاسخ
رو برام بفرست :",
      'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
	['text'=>"برگشت"]
	],
	]
	])]);
save_file("Learn_Words/$textmassaage.txt","هنوز یاد نگرفتم");
save_file("User_Data/$from_id/LastWord.txt",$textmassage);
}elseif ($user_step == 'pa3') {
save_file("User_Data/$from_id/file.txt","pa4");
$LastWord = file_get_contents("User_Data/$from_id/LastWord.txt");
$myfile2 = fopen("wordlist.txt", "a") or die("Unable to open file!");	
fwrite($myfile2, "$LastWord\n");
fclose($myfile2);
save_file("Learn_Words/$LastWord.txt","$textmassage");
	BitBotReq('sendmessage',[
			'chat_id'=>$chat_id,
			'text'=>"خیلی ممنون گلم حالا من یه چیز  یاد گرفتم دمتگرم.",
      'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
	['text'=>"لینک دعوت دوستان 🔗"],['text'=>"بهم یاد بده 🌟"]
	],
	[['text'=>"نظرتو بگو 📝"]],
	]
	])
			]);
}
elseif (file_exists("Learn_Words/$textmassage.txt")) {
        $send = file_get_contents("Learn_Words/$textmassage.txt");

        BitBotReq("sendMessage", [
            'chat_id' => $chat_id,
            'text' =>$send
        ]);

}
$txxt = file_get_contents('User_Data/users.txt');
$pmembersid = explode("\n",$txxt);
if (!in_array($chat_id,$pmembersid)){
 $aaddd = file_get_contents('User_Data/users.txt');
 $aaddd .= $chat_id."\n";
 file_put_contents('User_Data/users.txt',$aaddd);
}
/*
🚀 این سورس کد رو به‌صورت کاملاً رایگان از گنجینه برنامه‌نویسی بیت‌آموز دریافت کردی!  
🎯 جدیدترین سورس‌ها، آموزش‌ها و ابزارهای کاربردی رو همین الان از سایت ما دانلود کن:  
🌐 https://BitAmooz.com  

💡 دوست داری همیشه یک قدم جلوتر باشی؟  
هر روز کلی سورس رایگان، تکنیک‌های برنامه‌نویسی و نکات حرفه‌ای توی بیت‌آموز منتشر میشه!  
⏳ وقتشه که سطح کدنویسی خودتو ارتقا بدی!  
🔗 همین الان وارد سایت شو و سورس‌های بیشتری بگیر: https://BitAmooz.com  
*/
if (file_exists("error_log")){
	unlink("error_log");
}
?>