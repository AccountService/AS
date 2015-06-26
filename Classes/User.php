
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

        public function showBuyedKeys($DB) {

            $keys = $DB->getAllBuyedKeys($this->id);

            if($keys !== null){
                foreach ($keys as $key => $value) :
                    echo  "<h5>".$key.":"."</h5>" ;
                    echo "<ul>";

                    foreach($value as $key) {
                        $id = $DB->getIDbyKey($key);
                        echo "<li>ID: $id | Key: $key<input type='checkbox' name=\"$key\" value=\"$id\" class='checkbox'></li>";
                    }

                    echo "</ul>";
                    echo "<br>";

                endforeach;
            }
        }

    }