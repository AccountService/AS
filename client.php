<?php
$client = new GearmanClient();
$client->addServer('127.0.0.1');
$client->setTimeout(29000);
$haveGoodServer = $client->ping(1);
$data = $_GET['string'];
$res = $client->doNormal('function_revert_string_and_caps', $data);
echo $res;