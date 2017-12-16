<?php
/**
 * Created by PhpStorm.
 * User: mmartinez
 * Date: 19/06/2017
 * Time: 02:17 PM
 */
//include('../Header.php');

session_start();

require_once "../Modelo/LoginModelo.php";
$modelo = new  LoginModelo();

$_SESSION['logueado'] = false;
$_SESSION['usuario'] ="";

if (isset($_POST['login'])) {
    $usuario = $_POST['username'];
    $contra = $_POST['pass'];

    $obj = [
        'usuario' => $usuario,
        'contra' => $contra
    ];

    if ($respuesta = $modelo->login($obj)) {
        $salt = md5($contra);
        $password_encriptado = crypt($contra,$salt);

        if ($respuesta['Password'] == $password_encriptado) {
            echo '<script> alert("Bienvenido"); </script>';
            $_SESSION['logueado'] = true;
            $_SESSION['usuario'] = $respuesta['UserName'];
        } else {
            echo '<script> alert("Contraseña Incorrecta"); </script>';
        }
    } else {
        echo '<script> alert("Revise usuario y contraseña"); </script>';
    }
}

if ($_SESSION['logueado']) { 
    
    //header("Location: ../index.php");
    include_once '../Controlador/EmpresaControlador.php';
} else {
    include_once '../Vista/LoginVista.html';
}
?>