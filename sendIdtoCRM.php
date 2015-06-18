<?php
function sendId ($key_id_info ,$key_id,$user_id_info, $user_id, $address, $secret_key = null){
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

$keys = array();
foreach($_POST as $key => $value) {
    $keys[] = $key;
}

$info = json_encode($keys);
var_dump($info);
$answer = sendRequest('cancel', $info, '10.55.33.27/dev/addRefund.php');
echo $answer;