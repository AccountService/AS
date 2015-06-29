<?php

$loader = require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$request = Request::createFromGlobals();

$DB = new db();

$returnedInfo = array();

foreach($request->request as $key => $value){
    array_push($returnedInfo, $value);
}

$amount = array_pop($returnedInfo);

$cancel_info = array (
    'email' => $DB->getUserEmail($session->get('id')),
    'key_id' => $returnedInfo,
    'amount' => $amount
);



$info = json_encode($cancel_info);


echo $info;


$answer = $DB->sendData('cancel_info', $info, '10.55.33.27/dev/addRefund.php');

echo $answer;
