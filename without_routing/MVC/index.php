<?php

function __autoload($class)
{
    require str_replace('\\','/',$class) . '.php';
}
use lib\App;
$app = new App();
$app->run();