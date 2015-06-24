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
            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $answer[] = $row['gen_key'];
            }

            return $answer;
        }

    }
    class Adapter {
        private $db;

        public function __construct() {
            $config = parse_ini_file('config/db.ini');
            $this->db = new PDO("mysql:host={$config['host']};dbname={$config['db_name']};", $config['user'], $config['password']);
        }

        public function addkey($new_key){
            $query = $this->db->prepare("INSERT INTO generated_keys (gen_key) VALUES (:newkey)");
            $query->bindParam(':newkey',$new_key, PDO::PARAM_STR);
            $query->execute();
        }

        public function getKeys() {
            $keys = array();
            $query = $this->db->prepare("SELECT gen_key FROM generated_keys WHERE is_marked = 0");
            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $keys[] = $row['gen_key'];
            }

            return $keys;
        }

        public function getMarkedKeys() {
            $keys = array();
            $query = $this->db->prepare("SELECT gen_key FROM generated_keys WHERE is_marked = 1 AND user_ID = 0");
            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $keys[] = $row['gen_key'];
            }

            return $keys;
        }

        public function getIDbyKey($key) {
            $query = $this->db->prepare("SELECT id FROM generated_keys where gen_key=:key");
            $query->bindParam(':key',$key, PDO::PARAM_STR);
            $query->execute();

            $id = $query->fetch(PDO::FETCH_ASSOC);
            return $id['id'];
        }

        public function markKey($key) {
            $query = $this->db->prepare("UPDATE generated_keys SET is_marked = 1 WHERE gen_key = :key");
            $query->bindParam(':key', $key, PDO::PARAM_STR);

            $query->execute();
        }

        public function addUserID($key, $user_id) {
            $query = $this->db->prepare("UPDATE generated_keys SET user_ID = :user_id WHERE gen_key = :key");
            $query->bindParam(':key', $key, PDO::PARAM_STR);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            $query->execute();
        }

        public function getAllBuyedKeys($user_ID) {
            $keys = array();
            $query = $this->db->prepare("SELECT gen_key FROM generated_keys WHERE user_ID = :user_ID");
            $query->bindParam(':user_ID', $user_ID, PDO::PARAM_INT);
            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                $keys_body[] = $row['gen_key'];
            }
            if(isset($keys_body)) {
                foreach ($keys_body as $key => $value) {
                    $keys[getproductName($value[0])][] = $value;
                }
            }
            return $keys;
        }

        public function registration($name, $email, $password) {
            $query = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, password(:password))");
            $query->bindParam(':name',$name, PDO::PARAM_STR);
            $query->bindParam(':email',$email, PDO::PARAM_STR);
            $query->bindParam(':password',$password, PDO::PARAM_STR);
            $query->execute();
        }

        public function isUserExist($email) {
            $query = $this->db->prepare("SELECT email FROM users WHERE email=:email");
            $query->bindParam(':email',$email, PDO::PARAM_STR);
            $query->execute();

            if($query->fetch(PDO::FETCH_ASSOC) == false) {
                return false;
            }
            else {
                return true;
            }
        }

        public function isAuthorize($login, $password) {
            $query = $this->db->prepare("SELECT * FROM users WHERE email=:email AND password=password(:password)");
            $query->bindParam(':email',$login, PDO::PARAM_STR);
            $query->bindParam(':password',$password, PDO::PARAM_STR);
            $query->execute();
            if($query->fetch(PDO::FETCH_ASSOC) != false) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getUserId($login) {
            $query = $this->db->prepare("SELECT user_id FROM users where email=:email");
            $query->bindParam(':email',$login, PDO::PARAM_STR);

            $query->execute();
            $id = $query->fetch(PDO::FETCH_ASSOC);

            return $id['user_id'];
        }

        public function getUserName($id) {
            $query = $this->db->prepare("SELECT name FROM users where user_id=:id");
            $query->bindParam(':id',$id, PDO::PARAM_STR);

            $query->execute();
            $name = $query->fetch(PDO::FETCH_ASSOC);

            return $name['name'];
        }

        public function getUserEmail($id) {
            $query = $this->db->prepare("SELECT email FROM users where user_id=:id");
            $query->bindParam(':id',$id, PDO::PARAM_STR);

            $query->execute();
            $email = $query->fetch(PDO::FETCH_ASSOC);

            return $email['email'];
        }

        public function getLastKeys($count) {
            $query = $this->db->prepare("SELECT * FROM generated_keys ORDER BY id DESC LIMIT :count");
            $query->bindParam(':count',$count, PDO::PARAM_INT);
            $query->execute();

            $keys=$query->fetchAll(PDO::FETCH_ASSOC);
            return $keys;
        }

        public function getGeneratedKeysId($prod_id, $count) {
            include_once('generator.php');
            for($i=0; $i<$count; $i++) {
                $key = generate_key($prod_id);
                $query = $this->db->prepare("INSERT INTO generated_keys (gen_key) VALUES (:key)");
                $query->bindParam(':key',$key, PDO::PARAM_INT);
                $query->execute();
            }
            $query = $this->db->prepare("SELECT id, gen_key FROM generated_keys ORDER BY id DESC LIMIT :count");
            $query->bindParam(':count',$count, PDO::PARAM_INT);
            $query->execute();
            $key_id = $query->fetchAll(PDO::FETCH_ASSOC);
            $key_ids = array();
            foreach($key_id as $key => $value) {
                $key_ids[$value['id']] = $value['gen_key'];
            }

            return $key_ids;
        }


        public function deleteKey($key_id) {
            $query = $this->db->prepare("DELETE FROM generated_keys WHERE id=:key_id");
            $query->bindParam(':key_id',$key_id, PDO::PARAM_INT);
            $query->execute();
        }

        public function getProductId($prodName) {
            $file = file_get_contents("products.json");
            $json = json_decode($file);

            foreach($json->products as $key => $value) {
                if($value->name == $prodName) {
                    $prod_id = $value->id;
                }
            }

            if (isset($prod_id)) {
                return $prod_id;
            }
            else {
                return "Undefined product";
            }
        }

        function sendData($key_info ,$info, $address, $secret_key = null){
            $url = $address;
            $fields = array(
                $key_info => $info,
                'secret_key' => $secret_key
            );

            $fields_str = '';
            foreach($fields as $key=>$value) { $fields_str .= $key.'='.$value.'&'; }
            $fields_str = trim($fields_str, '&');

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_str);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }

        public function connectKeyToUser($key, $user_id) {
            $allMarkedKeys = getMarkedKeys(get_db_connect());
            if(in_array($key, $allMarkedKeys)) {
                $this->addUserID($key, $user_id);
                return true;
            }
            return false;
        }

        public function keyValidation($key) {
            $allKeys = $this->getKeys();

            if(in_array($key, $allKeys)) {
                $this->markKey($key);
                return true;
            }

            return false;
        }

    }

$Adapter = new Adapter();
