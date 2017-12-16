<?php
require_once('DAL.php');

class EmpresaModelo{    //cambiar el nombre por el nombre de este docuemnto sin .php o como linea 10 del controlador
    
    public function __construct(){
        $this->conexion = new DAL();
    }
    
    public function AgregarGastosmedicos($campos){  //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  '%s'=nombre(varchar),$d=numero(int o decimal) SIN INCLUIR EL ID
        $query=sprintf("Insert into gastosmedicos VALUES(default,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',%d)",$campos['empresa'],$campos['noruc'],$campos['representante'],$campos['noced'],$campos['email'],$campos['direccion'],$campos['negocio'],$campos['aseguradora'],$campos['otrosseguros'],$campos['requerimiento'],$campos['cantidad']); 
        return $this->conexion->query($query);
    }
    
    public function ActualizarGastosmedicos($campos){ //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) incluyendo el id al final cambiar
        $query=sprintf("Update gastosmedicos SET empresa='%s', noruc='%s', representante='%s', noced='%s', email='%s', direccion='%s', negocio='%s', aseguradora='%s', otrosseguros='%s', requerimiento='%s', cantidad='%d' WHERE id='%d' ",$campos['empresa'],$campos['noruc'],$campos['representante'],$campos['noced'],$campos['email'],$campos['direccion'],$campos['negocio'],$campos['aseguradora'],$campos['otrosseguros'],$campos['requerimiento'], $campos['cantidad'],$campos['id']); 
        return $this->conexion->query($query);
    }
    
    public function EliminarGastosmedicos($id)//revisar en controlador de esta misma 
    {
        $query = sprintf("DELETE FROM gastosmedicos WHERE id=%d",$id); //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->query($query);
    }

    public function obtenerGastosmedicos(){ // cambiar de Gastosmedicos por el nombre de esta misma
        $query="SELECT * FROM gastosmedicos"; //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }
    
    public function obtenerGastosmedicosPorNombre($nombre,$start, $limit){ //- revisar en controlador de esta misma 
        $query = sprintf("SELECT * FROM gastosmedicos where empresa like '%s%%' OR representante like '%%%s%%' limit %d,%d",$nombre,$nombre,$start,$limit);  //cambiar de clientes al nombre de base de datos y buscar dos campos
         //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante

        return $this->conexion->multiples_datos($query);
    }

    public function obtenerGastosmedicosPorRango($start, $limit){ //-revisar en controlador de esta misma s
        $query=sprintf("SELECT * FROM gastosmedicos limit %d,%d",$start,$limit); // -cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }

    public function obtenerTotalRegistros(){
        $query="SELECT COUNT(*) AS Reg FROM gastosmedicos";  //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->datos($query);
    }
    
    public function obtenerTotalRegistrosDeLaBusqueda($nombre){
        $query = sprintf("SELECT COUNT(*) AS Reg FROM gastosmedicos where empresa like '%s%%' OR representante like '%%%s%%'" , $nombre,$nombre);  //cambiar de clientes al nombre de base de datos y buscar dos campos
        //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante
        return $this->conexion->datos($query);
    }
    
}

?>