<?php
require_once('DAL.php');

class MedicoModelo{    //cambiar el nombre por el nombre de este docuemnto sin .php o como linea 10 del controlador
    
    public function __construct(){
        $this->conexion = new DAL();
    }
    
    public function AgregarSeguromedico($campos){  //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) SIN INCLUIR EL ID
        $query=sprintf("Insert into seguromedico VALUES(default,'%s','%s','%s','%d','%s','%s','%s','%s','%s','%s', %s, %s, %s, %s)",$campos['nom'],$campos['cedula'],$campos['fechanac'],$campos['tel'],$campos['correo'],$campos['dir'],$campos['sexo'],$campos['civil'],$campos['nompadre'],$campos['cedulapadre'],$campos['nommadre'],$campos['cedulamadre'],$campos['nomconyuge'],$campos['cedulaconyuge']); 
        return $this->conexion->query($query);
    }
    
    public function ActualizarSeguromedico($campos){ //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) incluyendo el id al final cambiar
        $query=sprintf("Update seguromedico SET nom='%s', cedula='%s', fechanac='%s', tel='%d', correo='%s', dir='%s', sexo='%s', civil='%s', nompadre='%s', cedulapadre='%s', nommadre='%d', cedulamadre='%d', nomconyuge='%d', cedulaconyuge='%d' WHERE id='%d' ",$campos['nom'],$campos['cedula'],$campos['fechanac'],$campos['tel'],$campos['correo'],$campos['dir'],$campos['sexo'],$campos['civil'],$campos['nompadre'],$campos['cedulapadre'], $campos['nommadre'],$campos['cedulamadre'], $campos['nomconyuge'],$campos['cedulaconyuge'], $campos['id']); 
        return $this->conexion->query($query);
    }
    
    public function EliminarSeguromedico($id)//revisar en controlador de esta misma 
    {
        $query = sprintf("DELETE FROM seguromedico WHERE id=%d",$id); //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->query($query);
    }

    public function obtenerSeguromedico(){ // cambiar de Gastosmedicos por el nombre de esta misma
        $query="SELECT * FROM seguromedico"; //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }
    
    public function obtenerSeguromedicoPorNombre($nombre,$start, $limit){ //- revisar en controlador de esta misma 
        $query = sprintf("SELECT * FROM seguromedico where nom like '%s%%' OR cedula like '%%%s%%' limit %d,%d",$nombre,$nombre,$start,$limit);  //cambiar de clientes al nombre de base de datos y buscar dos campos
         //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante
         return $this->conexion->multiples_datos($query);
    }

    public function obtenerSeguromedicoPorRango($start, $limit){ //-revisar en controlador de esta misma s
        $query=sprintf("SELECT * FROM seguromedico limit %d,%d",$start,$limit); // -cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }

    public function obtenerTotalRegistros(){
        $query="SELECT COUNT(*) AS Reg FROM seguromedico";  //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->datos($query);
    }
    
    public function obtenerTotalRegistrosDeLaBusqueda($nombre){
        $query = sprintf("SELECT COUNT(*) AS Reg FROM seguromedico where nom like '%s%%' OR cedula like '%%%s%%'" , $nombre,$nombre);  //cambiar de clientes al nombre de base de datos y buscar dos campos
        //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante
        return $this->conexion->datos($query);
    }
    
}

?>