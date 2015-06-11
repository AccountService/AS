<?php

    //Connects to our MySQL database;
    function get_db_connect() {
        $config = parse_ini_file('config/db.ini');
        $db = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};", $config['user'], $config['password']);
        return $db;
    }

    // Add new key into MySQL database
    function addkey($db,$new_key){
        $query = $db->prepare("INSERT INTO generated_keys (gen_key) VALUES (:newkey)");
        $query->bindParam(':newkey',$new_key, PDO::PARAM_STR);
        $query->execute();
    }


    // Function that return an array of keys with "IS_MARKED" = false;
    function getKeys($db) {                         
        $keys = array();
        $query = $db->prepare("SELECT gen_key FROM generated_keys WHERE is_marked = 0");
        $query->execute();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $keys[] = $row['gen_key'];
        }
        
        return $keys;
    }

    function getMarkedKeys($db) {
        $keys = array();
        $query = $db->prepare("SELECT gen_key FROM generated_keys WHERE is_marked = 1 AND user_ID IS NULL");
        $query->execute();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $keys[] = $row['gen_key'];
        }

        return $keys;
    }

    // Function that update 'is_marked' to 'true'
    // and create connection between user 
    // and key.
    function markKey($key, $db) {
        $query = $db->prepare("UPDATE generated_keys SET is_marked = 1 WHERE gen_key = :key");
        $query->bindParam(':key', $key, PDO::PARAM_STR);
        
        $query->execute();
    }


    function addUserID($key, $user_id, $db) {
          $query = $db->prepare("UPDATE generated_keys SET user_ID = :user_id WHERE gen_key = :key");
          $query->bindParam(':key', $key, PDO::PARAM_STR);
          $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

          $query->execute();
    }

    //Function that fill 'user_ID' column
    function connectKeyToUser($key, $user_id) {
        $allMarkedKeys = getMarkedKeys(get_db_connect());

        if(in_array($key, $allMarkedKeys)) {
            addUserID($key, $user_id, get_db_connect());

            return true;
        }

        return false;
    }


    // Function that compare key from html form with NySQL keys. $key --> string;
    function keyValidation($key) {
        $allKeys = getKeys(get_db_connect());           // returns all keys. getConnect() func. that connect to MySQL database;

        if(in_array($key, $allKeys)) {
            markKey($key, get_db_connect());

            return true;
        }

        return false;
    }

    //keyValidation('e5c6ca06454ec3774d8fb614c369a57506b89dc525d6201bd937ad2bb6f897251434035397.2816');
   connectKeyToUser('e5c6ca06454ec3774d8fb614c369a57506b89dc525d6201bd937ad2bb6f897251434035397.2816', 4);