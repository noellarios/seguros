<?php
require_once('DAL.php');

class IncendiosModelo{    //cambiar el nombre por el nombre de este docuemnto sin .php o como linea 10 del controlador
    
    public function __construct(){
        $this->conexion = new DAL();
    }
    
    public function AgregarIncendios($campos){  //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) SIN INCLUIR EL ID
        $query=sprintf("Insert into incendios VALUES(default,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',%s)",$campos['nom'],$campos['cedula'],$campos['sexo'],$campos['departamento'],$campos['correo'],$campos['dir'],$campos['objeto'],$campos['cobertura'],$campos['alarma'],$campos['hidrantes'],$campos['extintores']); 
        return $this->conexion->query($query);
    }
    
    public function ActualizarIncendios($campos){ //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) incluyendo el id al final cambiar
        $query=sprintf("Update incendios SET nom='%s', cedula='%s', sexo='%s', departamento='%s', correo='%s', dir='%s', objeto='%s', cobertura='%s', alarma='%s', hidrantes='%s', extintores='%d' WHERE id='%d' ",$campos['nom'],$campos['cedula'],$campos['sexo'],$campos['departamento'],$campos['correo'],$campos['dir'],$campos['objeto'],$campos['cobertura'],$campos['alarma'],$campos['hidrantes'],$campos['extintores'], $campos['id']); 
        return $this->conexion->query($query);
    }
    
    public function EliminarIncendios($id)//revisar en controlador de esta misma 
    {
        $query = sprintf("DELETE FROM incendios WHERE id=%d",$id); //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->query($query);
    }

    public function obtenerIncendios(){ // cambiar de Gastosmedicos por el nombre de esta misma
        $query="SELECT * FROM incendios"; //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }
    
    public function obtenerIncendiosPorNombre($nombre,$start, $limit){ //- revisar en controlador de esta misma 
        $query = sprintf("SELECT * FROM incendios where nom like '%s%%' OR cedula like '%%%s%%' limit %d,%d",$nombre,$nombre,$start,$limit);  //cambiar de clientes al nombre de base de datos y buscar dos campos
         //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante

        return $this->conexion->multiples_datos($query);
    }

    public function obtenerIncendiosPorRango($start, $limit){ //-revisar en controlador de esta misma s
        $query=sprintf("SELECT * FROM incendios limit %d,%d",$start,$limit); // -cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }

    public function obtenerTotalRegistros(){
        $query="SELECT COUNT(*) AS Reg FROM incendios";  //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->datos($query);
    }
    
    public function obtenerTotalRegistrosDeLaBusqueda($nombre){
        $query = sprintf("SELECT COUNT(*) AS Reg FROM incendios where nom like '%s%%' OR cedula like '%%%s%%'" , $nombre,$nombre);  //cambiar de clientes al nombre de base de datos y buscar dos campos
        //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante
        return $this->conexion->datos($query);
    }
    
}

?>