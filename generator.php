
<?php

function generate_key() { //генерируем ключ по заданному алгоритму (получаем абослютно точно уникальный ключ)

    $randomv = rand().rand().rand();
    $new_key = hash('sha256', $randomv);
    $new_key .= microtime(true);
    return $new_key;
}

function addtodb ($key){
//подключаемся к базе данных
//и добавляем ключ
    return true;
}
function createkeys($number) {
    $i = 0;
    while ($i<$number) {
        $key=generate_key();
        addtodb($key);
        echo "$key<br>";
        $i++;
    }

}

?>
