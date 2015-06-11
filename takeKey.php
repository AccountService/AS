<?php
include_once('generator.php');

    $json = json_decode($_POST['data'],true);
   echo  $json1=json_encode(createkeys( $json['count'], $json['id']));


?>