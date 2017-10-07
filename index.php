<?php

//FRONT CONTROLLER

//1. Общие настройки

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname('__FILE__'));

//2. Подключение файлов
require_once (ROOT.'/components/Router.php');


$router = new Router();

$router->run();