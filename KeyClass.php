<?php
    class Key
    {
        private $key;

        public function __construct($id)
        {
            $this->key = $this->generate_key($id);
        }

        public function generate_key($id)
        {                                // $id ---> product id
            $randomv = rand() . rand() . rand();

            $new_key = $id . '_' . hash('sha256', $randomv);
            $new_key .= microtime(true);
            return $new_key;
        }

        public function getKey() {
            echo $this->key;
        }
    }
