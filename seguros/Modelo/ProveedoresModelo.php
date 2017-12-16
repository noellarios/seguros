<?php
require_once('DAL.php');

class ProveedoresModelo{    //cambiar el nombre por el nombre de este docuemnto sin .php o como linea 10 del controlador
    
    public function __construct(){
        $this->conexion = new DAL();
    }
    
    public function AgregarProveedores($campos){  //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) SIN INCLUIR EL ID
        $query=sprintf("Insert into proveedores VALUES(default,'%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%s,'%s')",$campos['nom'],$campos['cedula'],$campos['dir1'],$campos['nomempresa'],$campos['correo'],$campos['dir2'],$campos['nomproyecto'],$campos['fecha'],$campos['valor'],$campos['beneficiario'],$campos['forma'],$campos['contrato']); 
        return $this->conexion->query($query);
    }
    
    public function ActualizarProveedores($campos){ //revisar en controlador de esta misma
        //-cambiar gastosmedicos abajo por el nombre de la tabla  %s=nombre(varchar),$d=numero(int o decimal) incluyendo el id al final cambiar
        $query=sprintf("Update proveedores SET nom='%s', cedula='%s', dir1='%s', nomempresa='%s', correo='%s', dir2='%s', nomproyecto='%s', fecha='%s', valor='%d', beneficiario='%s', forma='%s', contrato='%s' WHERE id='%d' ",$campos['nom'],$campos['cedula'],$campos['dir1'],$campos['nomempresa'],$campos['correo'],$campos['dir2'],$campos['nomproyecto'],$campos['fecha'],$campos['valor'],$campos['beneficiario'],$campos['forma'],$campos['contrato'], $campos['id']); 
        return $this->conexion->query($query);
    }
    
    public function EliminarProveedores($id)//revisar en controlador de esta misma 
    {
        $query = sprintf("DELETE FROM proveedores WHERE id=%d",$id); //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->query($query);
    }

    public function obtenerProveedores(){ // cambiar de Gastosmedicos por el nombre de esta misma
        $query="SELECT * FROM proveedores"; //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }
    
    public function obtenerProveedoresPorNombre($nombre,$start, $limit){ //- revisar en controlador de esta misma 
        $query = sprintf("SELECT * FROM proveedores where nom like '%s%%' OR cedula like '%%%s%%' limit %d,%d",$nombre,$nombre,$start,$limit);  //cambiar de clientes al nombre de base de datos y buscar dos campos
         //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante

        return $this->conexion->multiples_datos($query);
    }

    public function obtenerProveedoresPorRango($start, $limit){ //-revisar en controlador de esta misma s
        $query=sprintf("SELECT * FROM proveedores limit %d,%d",$start,$limit); // -cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->multiples_datos($query);
    }

    public function obtenerTotalRegistros(){
        $query="SELECT COUNT(*) AS Reg FROM proveedores";  //-cambiar gastosmedicos por nombre de la tabla de mysql de esta misma
        return $this->conexion->datos($query);
    }
    
    public function obtenerTotalRegistrosDeLaBusqueda($nombre){
        $query = sprintf("SELECT COUNT(*) AS Reg FROM proveedores where nom like '%s%%' OR cedula like '%%%s%%'" , $nombre,$nombre);  //cambiar de clientes al nombre de base de datos y buscar dos campos
        //en la tabla de informacion preferible los dos primeros como en este caso empresa y representante
        return $this->conexion->datos($query);
    }
    
}

?>