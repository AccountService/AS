
<?php
    class User {
        private $name;
        private $id;
        private $email;
        private $password;

        public function __construct($name,  $email, $password, $id = null) {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->id = $id;
        }

        public function getName() {
            return $this->name;
        }

        public function getID() {
            return $this->id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }
        public function setID($id) {
            $this->id = $id;
        }

        public function keyExist($DB) {
            $keys = $DB->getAllBuyedKeys($this->id);

            if($keys != null) {
                return true;
            } else {
                return false;
            }
        }

        public function showBuyedKeys($DB) {
            $keys = $DB->getAllBuyedKeys($this->id);
            $prods_keys =array();
            $i = 0;
            foreach ($keys as $key => $value) {
                echo "<h5>" . $key . ":" . "</h5>";
                echo "<ul class='collection'>";


                foreach ($value as $key) {
                    $prod_id = $DB->getProductIdByKey($key);
                    $id = $DB->getIDbyKey($key);
                    $prod_name = $DB->getproductName($prod_id);
                    $prods_keys[$i]['prod'] = $prod_name;
                    $prods_keys[$i]['key'] = $key;
                    echo $prod_name;
                    echo "<li class='collection-item'>ID: $id | Key: $key<input type='checkbox' name=\"$key\" value=\"$id\" class='checkbox'></li>";
                    $i++;
                }
                echo "</ul>";
                echo "<br>";

            }


        }
    }

