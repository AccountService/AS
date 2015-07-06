<?php

$loader = __DIR__.'/../../vendor/autoload.php';
$DB = new db();
$signer = new signurl();
if ($signer->CheckUrl('password')) {
    if (isset($_POST['orders'])) {
        $info = json_decode($_POST['orders'], true);

        foreach ($info['keys'] as $key => $value) {
            $DB->markKey($value);
            echo "$value <br>";
        }
    } else {
        echo "Error!!!";
    }
}