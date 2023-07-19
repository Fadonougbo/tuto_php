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
        $messagesList["formError"]="Name ou password incorrecte";
    }

    $user=false;

    if(empty($messagesList))
    {
        $auth=new Auth();

        $user=$auth->signUser($body);
        
    }

    if($user)
    {
        Session::setValue("user",$user);

        header("Location:/");
    }else 
    {
        $messagesList["formError"]="Veillez creer un compte";
    }
}


?>

<div id="container" >
    <h1>Page de connection</h1>
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
        <section id="button_container" >
            <button type="submit">sign in</button>
        </section>
    </form>
</div>