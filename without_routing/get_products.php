-<?php
$loader = require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();

file_put_contents('products.json', $request->request->get('products'));

?>