<?php

use GuzzleHttp\Psr7\ServerRequest;

$request=ServerRequest::fromGlobals();

if($match['name']==="home")
{

    ob_start();
        require dirname(__DIR__).D_S."template".D_S."home.php";
    $body=ob_get_clean();

    require dirname(__DIR__).D_S."template".D_S."base.php";
}

?>