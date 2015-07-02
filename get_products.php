<?php
$loader = require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();
echo $request->request->get('products');
file_put_contents('products.json', $request->request->get('products'));

?>