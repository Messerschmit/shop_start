<?php

//FRONT CONTROLLER

//1. Общие настройки

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname('__FILE__'));

session_start();

//2. Подключение файлов
require_once (ROOT.'/components/Autoload.php');


$router = new Router();

$router->run();