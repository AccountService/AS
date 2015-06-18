<?php
    include('pdo.php');

    var_dump($_POST);
    exit();

    $keys = array();
    foreach($_POST as $key => $value) {
        $keys[] = $key;
    }

    $info = json_encode($keys);
    var_dump($info);
    $answer = sendRequest('cancel', $info, '10.55.33.27/dev/addRefund.php');
    echo $answer;

