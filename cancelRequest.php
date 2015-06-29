<?php

session_start();

$loader = require_once __DIR__.'/vendor/autoload.php';
$DB = new db();

$returnedInfo = array();

foreach($_POST as $key => $value){
    array_push($returnedInfo, $value);
}

$amount = array_pop($returnedInfo);

$cancel_info = array (
    'email' => $DB->getUserEmail($_SESSION['id']),
    'key_id' => $returnedInfo,
    'amount' => $amount
);



$info = json_encode($cancel_info);


echo $info;


$answer = $DB->sendData('cancel_info', $info, '10.55.33.27/dev/addRefund.php');

echo $answer;
