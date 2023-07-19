<?php

use App\Session;

if(Session::deleteValue("user"))
{
    header("Location:/login");
}

?>