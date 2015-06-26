<?php
    class Key
    {

        public static function generate($prod_id)
        {                                // $id ---> product id
            $randomv = rand() . rand() . rand();

            $new_key = $prod_id . '_' . hash('sha256', $randomv);
            $new_key .= microtime(true);
            return $new_key;
        }


//        private function createkeys($number,$id) {
//            $i = 0;
//            $array='';
//            while ($i<$number) {
//                $key=generate_key($id);
//                addkey(get_db_connect(),$key);
//                $array[] = $key;
//                $i++;
//
//            }
//            return $array;
//        }

    }
