<?php
    include_once('pdo.php');
    $arr = json_decode($_POST['refunds'],true);

    foreach($arr as $value) {
        deleteKey(get_db_connect(),$value);
    }

?>