<?php

/* https://api.telegram.org/bot1085668639:AAF3E1zAHdM8VSMh7-Z4NSyGFtP-DuLYaa8/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

$name = $_POST['user_name'];
$phone = !empty($_POST['user_phone'])?$_POST['user_phone']:false;
$email = $_POST['user_email'];
$stat = $_POST['form_stat'];
$sity = $_POST['user_sity'];
$IPlist = get_ip_list();
$interval = $_POST['interval'];
$length = $_POST['length'];
$utm_source = $_POST['utm_source'];
$utm_medium = $_POST['utm_medium'];
$utm_campaign = $_POST['utm_campaign'];
$utm_content = $_POST['utm_content'];
$utm_term = $_POST['utm_term'];
$source = $_POST['source'];
$product = $_POST['product'];
$product_name = $_POST['product_name'];
$mess = $_SERVER['HTTP_REFERER'] ;
$token = "1085668639:AAF3E1zAHdM8VSMh7-Z4NSyGFtP-DuLYaa8";
$chat_id = "-1001455657180";
$arr = array(
  'Товар: ' => "Теплица",
  'Имя пользователя: ' => $name,
  'Телефон: ' => $phone,
  'Название в прайсе: ' => $product,
  'Название на сайте: ' => $product_name,
  "Шаг(X): " => $interval,
  "Длина(Y): " => $length,
  "Источник кампании: " => $utm_source,
  "Тип трафика: " => $utm_medium,
  "Название кампании: " => $utm_campaign,
  "Идентификатор объявления: " => $utm_content,
  "utm_term: " => $utm_term,
  "Тип площадки и площадка: " => $source,
  "Город: " => $sity,
  "Отзыв: " => $otz,
  "Ссылка: " => $mess
);

$all =
"Имя: ". $name. "
".
"Номер: ". $phone. "
".
"Название в прайсе: ". $product. "
".
"Название на сайте: ". $product_name. "
".
"Длина: ". $length. "
".
"Шаг: ". $interval. "
".
"IPlist: ". $IPlist. "
";

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};


$data = json_decode(file_get_contents('../blacklist.json'));
$flag = 0;
$ban;
for ($i = 0; $i < count($data); $i++){
	if (strpos($phone, $data[$i]->phone) !== false ){
		$flag = 1;
    $ban = "Бан по телефону: " . $phone;
	}
	else if ($data[$i]->ip == $IPlist){
		$flag = 1;
    $ban = "Бан по ip: " . $ip;
	}
}

if(strlen($phone)>6){
  if($flag == 0) {$sendToTelegram = mail("firmach.shark@gmail.com","Заявка с агросад.бел", $all);
  if ($sendToTelegram) {
    if((mt_rand() % 2) == 1){
      header('Location: thank/');}
      else{
        header('Location: bth/');
      }
} else {
echo "Error";
}}
else {$sendToTelegram = mail("fmcooper97@gmail.com","Мусор с агросад.бел", $all . $ban);
  header('Location: bth/');}
}else{
  $sendToTelegram = mail("fmcooper97@gmail.com","Мусор с агросад.бел", $all . $ban);
header('Location: bth/');
}


function get_ip_list()
{
	$list = array();
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$list = array_merge($list, $ip);
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$list = array_merge($list, $ip);
	} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
		$list[] = $_SERVER['REMOTE_ADDR'];
	}
	
	$list = array_unique($list);
	return implode(',', $list);
}
?>