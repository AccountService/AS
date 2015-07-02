<?php


namespace model;

use lib\Model;

class ProductModel extends Model {

    public function getProduct($id)
    {
        $arr = ['q'=> 'zero','w'=>'first','e'=>'second','r'=>'third'];
        return $arr[$id];
    }

}