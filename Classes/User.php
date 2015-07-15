
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

            foreach ($keys as $key => $value) {


                 asort($value);

                $value1 = $value;
                $prname =     $DB->getproductName($DB->getProductIdByKey(array_shift($value)));


                echo "<h1>$prname</h1>";

                foreach ($value1 as $key) {

                    if ($prname !== $DB->getproductName($DB->getProductIdByKey($key))) {
                        $prname = $DB->getproductName($DB->getProductIdByKey($key));
                        echo "<h1>$prname</h1>";
                    }

                    $id = $DB->getIDbyKey($key);
                         echo "<li class='collection-item'>ID: $id | Key: $key<input type='checkbox' name=\"$key\" value=\"$id\" class='checkbox'></li>";

                }



            }


        }
    }

