<?php
    class User {
        private $name;
        private $email;
        private $password;
        private $buyedKeys;

        public function __construct($name, $email, $password) {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setBuyedKeys($key){
            $this->buyedKeys[] = $key;
        }
    }