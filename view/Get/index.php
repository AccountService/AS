<?php
$loader ='/../../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;

$signer = new signurl();
if ($signer->CheckUrl('password')) {

    $request = Request::createFromGlobals();
    echo $request->request->get('products');
    file_put_contents(__DIR__.'/../../products.json', $request->request->get('products'));


}
