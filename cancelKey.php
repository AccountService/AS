<?php
    $loader = require_once __DIR__.'/vendor/autoload.php';
    $arr = json_decode($_POST['refunds'],true);
    $DB = new db();
    foreach($arr as $value) {
        $DB->deleteKey($value);
    }

?>