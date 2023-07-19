<?php  

namespace App;

use Exception;

class Session 
{
    public  static function startSession()
    {
        if(session_status()===PHP_SESSION_NONE)
        {
            session_start();
        }
    }



    public static function setValue(string $key, $value)
    {
        self::startSession();

        if( isset($_SESSION[$key]) )
        {
            throw new Exception('Cette clé exist déja');
        }

        $_SESSION[$key]=$value;

        return $value;

    }

    public static function keyExist(string $key):bool
    {   

        self::startSession();
        
        return isset($_SESSION[$key]);
    }

    public static function deleteValue(string $key)
    {
        self::startSession();
        if(self::keyExist("user"))
        {
            unset($_SESSION[$key]);
            return true;
        }

        return false;
    }

    public static function getValue(string $key)
    {
        self::startSession();

        if( !isset($_SESSION[$key]) )
        {
            throw new Exception("Cette clé n'exist pas");
        }

        return $_SESSION[$key];
    }
}


?>