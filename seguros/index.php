<?php

session_start();

if(!isset($_SESSION['logueado'])){
    $_SESSION['logueado']=false;
}

//var_dump($_SESSION['usuario']);
include('Header.php');
include ('cuerpo.php');
include ('pie.php');