<?php
    include('pdo.php');
    $keys = array('orders'=>'{"order_id":2,"keys":[1,2,4,5,7]}', 'secret_key'=>"");

    $keys_id = json_decode($keys['orders']);


    function setOrderId($db, $keys_id) {
        for($i=0; $i<count($keys_id->keys); $i++) {
            $query = $db->prepare("UPDATE generated_keys SET order_ID = :order_id WHERE id = :key_id");
            $query->bindParam(':order_id', $keys_id->order_id, PDO::PARAM_STR);
            $query->bindParam(':key_id', $keys_id->keys[$i], PDO::PARAM_STR);
            $query->execute();
        }
    }

setOrderId(get_db_connect(), $keys_id);