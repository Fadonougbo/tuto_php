<?php 

namespace App;
use PDO;

class Crud
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo=DB::getPdoConnection();
    }

    /**
     * recupère la liste de tous les messages
     *
     * @return string
     */
    public function getAllMessage():string
    {
        $q="SELECT * FROM users_messages
            LEFT JOIN users ON users.id=users_messages.user_id
            LEFT JOIN messages ON messages.id=users_messages.message_id
            ORDER BY created_at DESC
        ";
        $query=$this->pdo->prepare($q);

        $query->execute();

        return json_encode($query->fetchAll());
    }

    /**
     * Recupère l'utilisateur connecté
     *
     * @return string
     */
    public function getUser():string
    {
        $currentUser=Session::getValue("user");
        return json_encode(['id'=>$currentUser->id]);
    }

    /**
     * ajoute un message dans la base de données
     *
     * @return string
     */
    public function setMessage():string
    {
        $currentUser=Session::getValue("user");
        $user_id=$currentUser->id;
        $message=$_POST['message'];

        $q="INSERT INTO messages (message) VALUES(:message) ";
        $query=$this->pdo->prepare($q);

        $query->execute(["message"=>$message]);

        $lastID=$this->pdo->lastInsertId();

        if($lastID)
        {
            $q="INSERT INTO users_messages (user_id,message_id) VALUES(:user_id,:message_id) ";
            $query=$this->pdo->prepare($q);

            $res=$query->execute(["user_id"=>$user_id,"message_id"=>$lastID]);

            return $res?json_encode(["status"=>true]):json_encode(["status"=>false]);
        }

        return json_encode(["status"=>false]);
    }

}

?>