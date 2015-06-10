<?php
    function get_db_connect() {
        $config = parse_ini_file('config/db.ini');
        $db = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};", $config['user'], $config['password']);
        return $db;
    }
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


    // Function that update 'is_marked' to 'true'
    // and create connection between user 
    // and key.
    function markKey($key, $user_id, $db) {                                             
        $query = $db->prepare("UPDATE generated_keys SET is_marked = 1 WHERE gen_key = :key");
        $query->bindParam(':key', $key, PDO::PARAM_STR);
        
        $query->execute();

        $query = $db->prepare("UPDATE generated_keys SET user_ID = :user_id WHERE gen_key = :key");
        $query->bindParam(':key', $key, PDO::PARAM_STR);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        
        $query->execute();
    }




    // Function that compare key from html form with NySQL keys. $key --> string;
    function keyValidation($key) {              
        $allKeys = getKeys(get_db_connect());           // returns all keys. getConnect() func. that connect to MySQL database;

        if(in_array($key, $allKeys)) {
            markKey($key, 1, get_db_connect());
            echo "u're cool";
            return true;
        }
        echo 'fail';
        return false;
    }

   
