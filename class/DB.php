<?php 

namespace App;

use \PDO;

class DB
{
    private static ?PDO $pdo=null;

    public static function getPdoConnection():PDO
    {
        if (empty(self::$pdo))
        {
            self::$pdo=new PDO("{$_ENV['DRIVER']}:host=localhost;dbname={$_ENV['DB_NAME']}","{$_ENV['DB_USER']}","{$_ENV['DB_PASSWORD']}",
            [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
            ]);
        }

        return self::$pdo;
    }
}

?>