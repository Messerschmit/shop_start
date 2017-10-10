<?php


class Db
{
    /**
     * Return connection to main database
     * @return $db
     * */
    public static function getConnection()
    {
        $paramsPath = ROOT.'/config/db_param.php';

        $params = include ($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        $db = new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $db->exec("set names utf8");

        return $db;
    }
}