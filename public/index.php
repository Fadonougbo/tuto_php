<?php

require dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define("D_S",DIRECTORY_SEPARATOR);

$router=new AltoRouter();

$router->map("GET","/","","home");
$router->map("GET|POST","/login","","sign_in");
$router->map("POST",'/logout','','logout');
$router->map("GET|POST",'/create','','sign_up');

/********API route*********** */
$router->map("GET","/user","","user");
$router->map("POST","/messages","","message_list");
$router->map("POST","/new/message","","new_message");
/*********************************/

$match=$router->match();

if($match)
{
    require dirname(__DIR__).D_S."class".D_S."Base.php";
}else 
{
    echo json_encode(['message'=>"page not found"]);
}


?>