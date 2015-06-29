<?php

    abstract Class dbConnector
    {

    public function queryExecute($db,$request, $arrayOfParams = null){

    $query = $db->prepare("$request");
    if($arrayOfParams !=null){

    foreach ($arrayOfParams as $key => $value){

    $query->bindValue(":$key",$value, PDO::PARAM_STR);

    }
    }

    $query->execute();
    return $query;
    }

    public function fetcher($query) {
    $answer = [];
    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
    $answer[] = $row['gen_key'];
    }

    return $answer;
    }

    }