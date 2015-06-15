<?php

$regInfo = array('name' => $_POST['name'], 'email' => $_POST['email']);

$regInfo = json_encode($regInfo);
//var_dump($regInfo);


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



    include_once('pdo.php');
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass_again'])) {
        if(isUserExist(get_db_connect(), $_POST['email'])) {
            echo "<center>User is already exist!</center>";
        } else {
            if ($_POST['pass'] == $_POST['pass_again']) {
                registration(get_db_connect(), $_POST['name'], $_POST['email'], $_POST['pass']);


                echo "<script>location.href = 'auth.php';</script>";
            } else {
                echo "<center>Passwords do not match!</center>";
            }
        }
    }

    echo '<center><a href="signup.php">return to register</a></center>';

