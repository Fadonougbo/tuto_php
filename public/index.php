<?php

require dirname(__DIR__).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

define("D_S",DIRECTORY_SEPARATOR);

$router=new AltoRouter();

$router->map("GET","/","","home");

$match=$router->match();

if($match)
{
    require dirname(__DIR__).D_S."class".D_S."Base.php";
}else 
{
    echo "page not found";
}


?>