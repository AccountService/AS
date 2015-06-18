<?php

var_dump($_POST);


/*
    //$keys = $_POST['order_keys'];
    $keys = array("order_id"=>69, "keys")
    $keys_id = json_decode($keys);
    var_dump($keys);
    function setOrderId($db, $order_id, $key_id) {
        $query = $db->prepare("UPDATE generated_keys SET order_ID = :order_id WHERE id = :key_id");
        $query->bindParam(':order_id', $order_id, PDO::PARAM_STR);
        $query->bindParam(':id', $key_id, PDO::PARAM_STR);
        $query->execute();
    }

   /* foreach($keys_id as $key => $value) {
        if($key=="order_id"){
            $order_id = $value;
        }
    }

    foreach ($keys_id as $key => $value) {
        if($key!="order_id") {
            setOrderId(get_db_connect(), $order_id, $value);
        }
    }*/
