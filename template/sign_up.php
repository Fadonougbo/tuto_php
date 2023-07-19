<?php

use App\Auth;
use App\Session;

if(Session::keyExist("user"))
{
    header("Location:/");
}

$body=$request->getParsedBody();

$messagesList=[];

if($request->getMethod()==="POST")
{
    if( !isset($body["name"],$body["password"]) )
    {
        $messagesList["formError"]="Name ou password incorrecte";
    }

    if(empty($body["name"]) || empty($body["password"]))
    {
        $messagesList["formError"]="Nom ou Mot de passe trop incorrecte";
    }

    if(strlen($body['name'])<3 || strlen($body['password'])<3 )
    {
        $messagesList["formError"]="La taille du nom et du mot de passe doivent etre superieur à 3 charactères";
    }

    $user=false;

    if(empty($messagesList))
    {
        $auth=new Auth();

        $user=$auth->registerUser($body);
        
    }

    if($user)
    {
        Session::setValue("user",$user);

        header("Location:/");
    }
}


?>


<div id="container" >
    <h1>Page d'inscription</h1>
    <section>
       <?php if(!empty($messagesList)): ?>
        <ul>
            <?php foreach($messagesList as $message): ?>
                <li><strong><?= $message; ?></strong></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
    </section>
    <form action="" method="POST">
        <section>
            <input type="text" name="name" value="<?= $_POST['name']??'' ?>" placeholder="John doe" >
        </section>
        <section>
            <input type="password" name="password" placeholder="****">
        </section>
        <section>
            <button type="submit">sign up</button>
        </section>
    </form>
</div>