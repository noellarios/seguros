<?php
require_once "DAL.php";

class RegistrarseModelo
{
    public function __construct()
    {
        $this->conexion = new DAL();
    }

    public function AgregarUsuario($campos){
        $query = sprintf("Insert Into usuarios VALUES (DEFAULT , '%s','%s','%s','%s',%d)",$campos['fullname'],$campos['correo'],$campos['username'],$campos['password'],$campos['activo']);
        return $this->conexion->query($query);
    }

}

?>