<?php
$loader = '/../../vendor/autoload.php';
$DB = new db();
if(isset($_POST['orders'])) {

    $info = json_decode($_POST['orders'], true);

    foreach ($info['keys'] as $key => $value) {
        $DB->markKey($value);
    }
} else {
    echo "Error!!!";
}