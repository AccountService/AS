<?php
$loader = '/../../vendor/autoload.php';

if(isset($_POST['orders'])) {
    $DB = new db();
    $info = json_decode($_POST['orders'], true);

    foreach ($info['keys'] as $key => $value) {
        $DB->markKey($value);
    }
} else {
    echo "Error!!!";
}