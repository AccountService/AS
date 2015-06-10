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

?>