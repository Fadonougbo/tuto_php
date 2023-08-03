<?php

use App\Crud;
use GuzzleHttp\Psr7\ServerRequest;

$request=ServerRequest::fromGlobals();

$webRouteExist=in_array($match['name'],["home","sign_in","logout","sign_up"]);
$apiRouteExist=in_array($match['name'],['user',"new_message",'message_list']);

if($webRouteExist)
{

    ob_start();
        require dirname(__DIR__).D_S."template".D_S.$match['name'].".php";
    $body=ob_get_clean();

    require dirname(__DIR__).D_S."template".D_S."base.php";

}else if($apiRouteExist)
{
    $crud=new Crud();

    $value=match($match['name'])
    {
        "message_list"=>$crud->getAllMessage(),// "/messages"
        "new_message"=>$crud->setMessage(),// "/new/message"
        "user"=>$crud->getUser(),// "/users"
        "default"=>json_encode(["message"=>"empty"])
    };
    
    echo $value;
}else 
{
    echo json_encode("Aucune action n'est lié a cette route ");
}

?>