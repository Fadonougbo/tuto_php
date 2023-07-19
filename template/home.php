<?php

use App\Session;


if(!Session::keyExist("user"))
{
    header("Location:/login");
}

$user=Session::getValue("user");

?>

    <?php if($user): ?>
        <section id="userinfo" >
            <h1>
                <?="User:".$user->name;  ?>  
            </h1>
            <form action="/logout" method="POST">
                <button type="submit" >Se deconneter</button>
            </form>
        </section>
    <?php endif ?>
<main id="" >

    <div id="message_list" >

    </div>
    <form action=""  method="POST" id="message_form">
        <textarea name="message" id="" cols="30" rows="10" placeholder="Votre message"></textarea>
        <button type="submit" >send</button>
    </form>

</main>