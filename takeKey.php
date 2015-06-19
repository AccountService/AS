<?php
include_once('generator.php');


    $json = json_decode($_POST['data'],true);


    echo $json['id_product'];
    echo $json['count'];
?>