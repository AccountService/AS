<?php
include_once('pdo.php');


    $json = json_decode($_POST['data'],true);
    $id_product = $json['id_product'];
    $count = $json['count'];

    echo json_encode(getGeneratedKeysId(get_db_connect(),  $id_product, $count));
?>