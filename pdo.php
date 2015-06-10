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
        echo 'asd';
    }

    function validateKey($db, $key) {
        $query = $db->prepare("SELECT gen_key FROM generated_keys WHERE gen_key=:key");
        $query->bindParam(':key',$key, PDO::PARAM_STR);
        $query->execute();
        $valid_key = false;
        if(fetch(PDO::FETCH_ASSOC)!=false) {
            return true;
        } else return false;
    }


?>