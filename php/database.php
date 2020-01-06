<?php
    class Database
    {
        public static $dbh;

        public static function getDbh()
        {
            $host = "localhost";
            $dbname = "blog";
            $user = "root";
            $pass = "";

            self::$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            return self::$dbh;
        }

        // Возвращает одномерный массив
        public static function query($query)
        {
            $sth = self::getDbh()->prepare($query);
            $sth->execute();
            $data = $sth->fetch(PDO::FETCH_ASSOC);

            return $data;
        }

        // Возвращает двумерный массив
        public static function queryAll($query)
        {
            $sth = self::getDbh()->prepare($query);
            $sth->execute();
            $data = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }

        // Выполнение запросов, которые не требуют дальнейшего возвращения результата
        public static function queryExecute($query)
        {
            $sth = self::getDbh()->prepare("$query");
            $sth->execute();
        }
    }

    // Для вывода данных используется такая конструкция:
    // foreach ($sql = DB::query("SELECT * FROM users") as $data)
    // {
    //    echo $data['user_email'];
    // }
?>