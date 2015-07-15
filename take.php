<?php
require_once(__DIR__.'/vendor/autoload.php');
use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();
$secret_key = 'secret_payment';
$json = json_decode($request->request->get('data'),true);
$id_product = $json['id_product'];
$count = $json['count'];
$DB = new db();
$hash = new signurl();
if ($hash->CheckUrl('secret')){
    echo json_encode($DB->getGeneratedKeysId($id_product, $count));
};