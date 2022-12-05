<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ChatGPT APIサンプル</title>
</head>
<body>

<?php
//
// OpenAI のアカウントを作成 ( https://beta.openai.com/signup )
// API Key を取得 ( https://beta.openai.com/account/api-keys )
//
$TEXT = 'ワールドカップ優勝国は？';
$API_KEY = '取得したAPIキーを入力';

$header = array(
	'Authorization: Bearer '.$API_KEY,
	'Content-type: application/json',
);

$params = json_encode(array(
	'prompt'		=> $TEXT,
	'model'			=> 'text-davinci-003',
	'temperature'	=> 0.5,
	'max_tokens'	=> 4000,
	'top_p'			=> 1.0,
	'frequency_penalty'	=> 0.8,
	'presence_penalty'	=> 0.0
));


$curl = curl_init('https://api.openai.com/v1/completions');
$options = array(
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER =>$header,
    CURLOPT_POSTFIELDS => $params,
    CURLOPT_RETURNTRANSFER => true,
);
curl_setopt_array($curl, $options);
$response = curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

if(200 == $httpcode){
	$json_array = json_decode($response, true);
	$choices = $json_array['choices'];
	foreach($choices as $v){
		echo $v['text'].'<br />';
	}
}
?>
</body>
</html>
