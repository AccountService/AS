<?php

$loader = require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();

$arr = json_decode($request->request->get('refunds'),true);
$DB = new db();
foreach($arr as $value) {
    $DB->deleteKey($value);
}