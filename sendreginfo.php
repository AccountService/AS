<?php

$regInfo = array('name' => $_POST['name'], 'email' => $_POST['email']);
$regInfo = json_encode($regInfo);

function sendData($key_info ,$info, $address, $secret_key = null){
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


