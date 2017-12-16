<?php
/**
 * Created by PhpStorm.
 * User: mmartinez
 * Date: 19/06/2017
 * Time: 08:32 PM
 */
session_start();
session_destroy();
/* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header("Location: http://$host$uri/$extra");
