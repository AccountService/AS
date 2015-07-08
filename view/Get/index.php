<?php
$loader = '/../../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;

$signer = new signurl();
file_put_contents('/../../products.json', 'lol');
if ($signer->CheckUrl('password')) {

    $request = Request::createFromGlobals();
    echo $request->request->get('products');
    file_put_contents('/../../products.json', $request->request->get('products'));

}
