<?php
$secret_key = 'secret_payment';
$json = json_decode($_POST['data'],true);
$id_product = $json['id_product'];
$count = $json['count'];
require_once(__DIR__.'/vendor/autoload.php');
$DB = new db();
$hash = new signurl();
if ($hash->CheckUrl('secret')){

    echo json_encode($DB->getGeneratedKeysId($id_product, $count));
};
