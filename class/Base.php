<?php

use App\Crud;
use GuzzleHttp\Psr7\ServerRequest;

$request=ServerRequest::fromGlobals();

$webRouteExist=in_array($match['name'],["home","sign_in","logout","sign_up"]);

if($webRouteExist)
{

    ob_start();
        require dirname(__DIR__).D_S."template".D_S.$match['name'].".php";
    $body=ob_get_clean();

    require dirname(__DIR__).D_S."template".D_S."base.php";

}else if(!$webRouteExist)
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
}else 
{
    throw new Exception("Aucune action n'est lié a cette route ");
}

?>