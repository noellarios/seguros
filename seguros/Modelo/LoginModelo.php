<?php

/**
 * Created by PhpStorm.
 * User: mmartinez
 * Date: 19/06/2017
 * Time: 07:26 PM
 */

require_once "DAL.php";

class LoginModelo
{
    public function __construct()
    {
        $this -> conexion = new DAL();
    }

    public function login($user){
        $query = sprintf("SELECT * FROM Usuarios WHERE username='%s'",$user['usuario']);
        return $this->conexion->datos($query);
    }

}