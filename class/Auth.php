<?php

namespace App;

use \PDO;

class Auth 
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo=DB::getPdoConnection();
    }

    /**
     * Creation d'un nouveau utilisateur
     *
     * @param array $userinfo donnée de connection
     * @return void|bool
     */
    public function registerUser(array $userinfo)
    {
        $name=$userinfo['name'];
        $password=$userinfo["password"];

        $hash=password_hash($password,PASSWORD_DEFAULT,['cost'=>10]);

        $q="INSERT INTO users (name,password) VALUES(:name,:password)";

        $query=$this->pdo->prepare($q);

        $status=$query->execute(["name"=>$name,"password"=>$hash]);

        if(!$status)
        {
            return false;
        }

        return $this->signUser($userinfo);
    }

    /**
     * Authentification d'un utilisateur
     *
     * @param array $userinfo
     * @return void|bool
     */
    public function signUser(array $userinfo)
    {
        $name=$userinfo['name']??"";
        $password=$userinfo['password']??'';


        $q="SELECT * FROM users WHERE name=:name";

        $query=$this->pdo->prepare($q);

        $userNameExist=$query->execute(["name"=>$name]);

        if(!$userNameExist)
        {
            return false;
        }

        $user=$query->fetch();
        
        if(!$user)
        {
            return false;
        }

        $passwordVerification=password_verify($password,$user->password);

        return $passwordVerification?$user:false;
    }


}

?>