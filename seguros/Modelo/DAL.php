<?php
class DAL{
    private $conexion;
    const BASE = 'testseguros';
    const SERVER = '127.0.0.1';//'192.168.2.8';//'';//'192.168.2.7';//'192.168.3.154';
    const PASS = 'admin';
    const USER = 'root';//'ies';

    public function __construct()
    {
        $this->conexion = mysqli_connect(self::SERVER, self::USER, self::PASS) or die('Error conectando a la base de datos');

        if (!mysqli_select_db($this->conexion, self::BASE)) {
            echo 'Error conectando a la base de datos';
        }
    }

    //Este metodo se utilizara para ejecutar sentencias sql Insert, UpDate y Delete
    public function query($query)
    {
        if (mysqli_query($this->conexion,$query)) {
            return true;
        } else {
            return false;
        }
    }

    /**El metodo datos Retorna un solo registro*/
    public function datos($query)
    {
        if ($d = mysqli_query($this->conexion, $query)) {
            return mysqli_fetch_array($d);
        } else {
            return false;
        }
    }

    /** Retorna múltiples datos de una consulta */
    public function multiples_datos($query)
    {
        $array = array();
        if ($d = mysqli_query($this->conexion, $query)) {
            while ($res = mysqli_fetch_assoc($d)) {
                $array[] = $res;
            }
            return $array;
        } else {
            return false;
        }
    }
    
    
    
    
}
