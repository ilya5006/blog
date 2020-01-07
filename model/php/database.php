<?php
class Database
{
    private static $mysqli;

    public static function connect()
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'blog';

        self::$mysqli = new mysqli($host, $user, $password, $database);
    }

    // Запрос, который возвращает одномерный массив
    public static function query($query)
    {
        $queryResult = self::$mysqli->query($query);
        return $queryResult->fetch_assoc();
    }

    // Запрос, который возвращает двумерный массив
    public static function queryAll($query)
    {
        $queryResult = self::$mysqli->query($query);
        return $queryResult->fetch_all(MYSQLI_ASSOC);
    }

    public static function queryExecute($query)
    {
        return self::$mysqli->query($query);
    }
}
Database::connect();
?>