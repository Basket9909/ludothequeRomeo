<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
}

?>