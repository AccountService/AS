<?php

session_start();

include('pdo.php');

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

$returnedInfo = array();

foreach($_POST as $key => $value){
    array_push($returnedInfo, $value);
}

$amount = array_pop($returnedInfo);

$cancel_info = array (
    'email' => getUserEmail(get_db_connect(), $_SESSION['id']),
    'key_id' => $returnedInfo,
    'amount' => $amount
);



$info = json_encode($cancel_info);


echo $info;


$answer = sendKeyId('cancel_info', $info, '10.55.33.27/dev/addRefund.php');


echo $answer;
