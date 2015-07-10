<?php

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$loader = __DIR__.'/../../vendor/autoload.php';
$DB = new db();
$signer = new signurl();
if ($signer->CheckUrl('password')) {
    if ($request->request->has('orders')) {
        $info = json_decode($request->request->get('orders'), true);

        foreach ($info['keys'] as $key => $value) {
            $DB->markKey($value);
            echo "$value <br>";
        }
    } else {
        echo "Error!!!";
    }
}