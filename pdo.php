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

    function getAllBuyedKeys($user_ID, $db) {
        $keys = array();
        $query = $db->prepare("SELECT gen_key FROM generated_keys WHERE user_ID = :user_ID");
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

    function registration($db, $name, $email, $password) {
        $query = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, password(:password))");
        $query->bindParam(':name',$name, PDO::PARAM_STR);
        $query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
    }

    function isUserExist($db, $email) {
        $query = $db->prepare("SELECT email FROM users WHERE email=:email");
        $query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->execute();
        if($query->fetch(PDO::FETCH_ASSOC) == false) {
            return false;
        } else {
            return true;
        }
    }

    function isAuthorize($db, $login, $password) {
        $query = $db->prepare("SELECT * FROM users WHERE email=:email AND password=password(:password)");
        $query->bindParam(':email',$login, PDO::PARAM_STR);
        $query->bindParam(':password',$password, PDO::PARAM_STR);
        $query->execute();
        if($query->fetch(PDO::FETCH_ASSOC) != false) {
            return true;
        } else {return false;}
    }

    function getUserId($db, $login) {
        $query = $db->prepare("SELECT user_id FROM users where email=:email");
        $query->bindParam(':email',$login, PDO::PARAM_STR);
        $query->execute();
        $id = $query->fetch(PDO::FETCH_ASSOC);
        return $id['user_id'];
    }

    function getUserName($db, $id) {
        $query = $db->prepare("SELECT name FROM users where user_id=:id");
        $query->bindParam(':id',$id, PDO::PARAM_STR);
        $query->execute();
        $name = $query->fetch(PDO::FETCH_ASSOC);
        return $name['name'];
    }

    function getUserEmail($db, $id) {
        $query = $db->prepare("SELECT email FROM users where user_id=:id");
        $query->bindParam(':id',$id, PDO::PARAM_STR);
        $query->execute();
        $email = $query->fetch(PDO::FETCH_ASSOC);
        return $email['email'];
    }

    function getProductId($prodName) {
        $file = file_get_contents("products.json");
        $json = json_decode($file);
        foreach($json->products as $key => $value) {
            if($value->name == $prodName) {
                $prod_id = $value->id;
            }
        }
        if (isset($prod_id)) {
            return $prod_id;
        } else {return "Undefined product";}
    }

    function getproductName($prodId) {
        $file = file_get_contents("products.json");
        $json = json_decode($file);
        foreach($json->products as $key => $value) {
            if($value->id == $prodId) {
                $prod_name = $value->name;
            }
        }
        if (isset($prod_name)) {
            return $prod_name;
        } else {return "Undefined product";}
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

function echoCounter() {
    echo '              <div class="form-group">
						    <input id="colorful" class="form-control" type="number" value="1" min="1" max="10" />
                        </div>

                        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
                        <script src="bootstrap-number-input.js" ></script>
                        <script>
                            // Remember set you events before call bootstrapSwitch or they will fire after bootstrapSwitchs events
                            $("[name=\'checkbox2\']").change(function() {
                                    if(!confirm(\'Do you wanna cancel me!\')) {
                                       this.checked = true;
                                     }
                            });

                            $(\'#after\').bootstrapNumber();
                            $(\'#colorful\').bootstrapNumber({
	                        upClass: \'success\',
	                        downClass: \'danger\'
                            });
                        </script>';
}