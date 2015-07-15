<?php

$loader = '/../../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
$request = Request::createFromGlobals();
$signer = new signurl();
if ($signer->CheckUrl('password')){
    $arr = json_decode($request->request->get('refunds'),true);

    if (!empty($arr)){
    $DB = new db();

        foreach($arr as $value) {
             $DB->deleteKey($value);
        }
        echo '<center>
                <h1>Everything Done ;)</h1>
             </center>';
    }   else{
        echo '<center>
                <h1>Something wrong<br>You have made a mistake</h1>
             </center>';
        }
}   else {
        echo 'WRONG PASSWORD';
    }
?>
