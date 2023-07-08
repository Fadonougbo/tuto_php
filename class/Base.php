<?php

use App\Crud;
use GuzzleHttp\Psr7\ServerRequest;

$request=ServerRequest::fromGlobals();

if($match['name']==="home")
{

    ob_start();
        require dirname(__DIR__).D_S."template".D_S."home.php";
    $body=ob_get_clean();

    require dirname(__DIR__).D_S."template".D_S."base.php";

}else
{
    $crud=new Crud();

    $value=match($match['name'])
    {
        "message_list"=>$crud->getAllMessage(),
        "new_message"=>$crud->setMessage(),
        "user"=>$crud->getUser(),
        "default"=>json_encode(["message"=>"empty"])
    };
    
    echo $value;
}

?>