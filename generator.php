
<?php
    include_once('pdo.php');
//генерируем ключ по заданному алгоритму (получаем абослютно точно уникальный ключ)
    function generate_key($id) {
        $randomv = rand().rand().rand();

        $new_key = $id.hash('sha256', $randomv);
        $new_key .= microtime(true);
        return $new_key;
}

//генерирует количество ключей, равное переменной $number, на выходе получаем все ключи в массиве
    function createkeys($number,$id) {
        $i = 0;
        $array='';
         while ($i<$number) {
             $key=generate_key($id);
             addkey(get_db_connect(),$key);
             $array  .= "$key<br>\n";
             $i++;

         }
    return $array;
}

?>
