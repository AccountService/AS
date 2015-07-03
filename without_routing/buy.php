<?php
include('Classes/db.php');

if(isset($_POST['orders'])) {
    $info = json_decode($_POST['orders'], true);
    var_dump($info);
    exit();
    $DB = new db();

    foreach ($keys as $key_id) {
        $DB->deleteKey($key_id);
    }
} else {
    echo "Error!!!";
}

exit();