<?php
//namespace Products;

class Product {
    private $productName;
    private $productId;
    private $productPrice;

    public function __construct($prId) {
   //     $this->$productName = $prId; заглушка
        $this->$productId = $prId;
    //    $this->$productPrice = $prId; заглушка
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
new Product(10);