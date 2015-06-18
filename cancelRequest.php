<?php

function sendKeyId ($key_info, $info, $address, $secret_key = null){
    $url = $address;
    $fields = array(
        $key_info => $info,
        'secret_key' => $secret_key
    );

    $fields_str = '';
    foreach($fields as $key=>$value) { $fields_str .= $key.'='.$value.'&'; }
    $fields_str = trim($fields_str, '&');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}


$cancel_info = array(
    'keys' => array(1,2,3,4,5,6,7,8,9,10,11),
    'email' => 'ololo@ololo',
    'orderId' => '12',
    'ammount' => '117'
);

$info = json_encode($cancel_info);
var_dump($info);
$answer = sendKeyId('cancel_info', $info, '10.55.33.27/dev/addRefund.php');


echo $answer;
