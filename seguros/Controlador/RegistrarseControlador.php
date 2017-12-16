<?php
session_start();
require_once '../Modelo/RegistrarseModelo.php';
$_SESSION['logueado'] = false;

$modelo=new RegistrarseModelo();

if(isset($_POST['registrar'])){
    $salt = md5($_POST['password']);
    $password_encriptado = crypt($_POST['password'],$salt);
    $obj=[
        'fullname' => $_POST['fullname'],
        'correo' => $_POST['correo'],
        'username' => $_POST['username'],
        'password' => $password_encriptado,
        'activo' => 1
        ];
    if($modelo->AgregarUsuario($obj)){
        $_SESSION['logueado'] = true;

        echo '<script> alert("Usuario agregado"); </script>';
    }else{
        echo '<script> alert("Error al agregar Usuario"); </script>';
    }
}

if ($_SESSION['logueado']) {
    $_SESSION['usuario'] = $_POST['username'];
    //include_once '../Vista/Registrarse.html';
    include_once '../Controlador/ClienteControlador.php';
} else{
    include_once '../Vista/Registrarse.html';
}
?>