<?php

if(empty($_SESSION['usuario'])){
    session_start();
}

require_once('../Modelo/MedicoModelo.php');   //-Nombre del modelo de este tipo
$_SESSION['loguedo']=true;

$modelo = new MedicoModelo(); //-Nombre del modelo de este tipo
//Variables de control para la edición de registro de cliente
$editarseguromedico = false;  //-nombre de html de vista ejemplo editar + nombre del html
$editarid="";

if(isset($_POST['agregar'])){
    $obj = [                                         //-agregar todos los names del html sin agregar el "id"
           'nom' => $_POST['nom'],
           'cedula' => $_POST['cedula'],
           'fechanac' => $_POST['fechanac'],
           'tel' => $_POST['tel'],
           'correo' => $_POST['correo'],
           'dir' => $_POST['dir'],
           'sexo' => $_POST['sexo'],
           'civil' => $_POST['civil'],
           'nompadre' => $_POST['nompadre'],
           'cedulapadre' => $_POST['cedulapadre'],
           'nommadre' => $_POST['nommadre'],
           'cedulamadre' => $_POST['cedulamadre'],
           'nomconyuge' => $_POST['nomconyuge'],
           'cedulaconyuge' => $_POST['cedulaconyuge'],
           ];
        
    if($modelo->AgregarSeguromedico($obj)){  //nombre del html solo primera letra en Mayuscula Agregar + Gastosmedicos
        echo "<script> alert('Asegurado Agregado'); </script>";  
    }else{
     echo "<script> alert('Error no se registro el asegurado en la base de datos'); </script>"; 
    }
}

if(isset($_REQUEST['opcion'])){
    
       
   if ($_REQUEST['opcion'] == 'editar') {

        $editarseguromedico = true;   //-como html igual que linea 12 de este documento mismo nombre 
        $editarid = $_REQUEST['id'];

    } elseif ($_REQUEST['opcion'] == 'cancelar') {

        $editarseguromedico = false; //-como html igual que linea 12 de este documento mismo nombre 
        $editarid = '';

    } elseif ($_REQUEST['opcion'] == 'guardar') {
        $editarseguromedico = false;  //-como html igual que linea 12 de este documento mismo nombre 
        $editarid = '';

        $objeto = [                        //-copiar de aqui a bajo desde la linea 17 hasta ] dejando el id al final
           'nom' => $_POST['nom'],
           'cedula' => $_POST['cedula'],
           'fechanac' => $_POST['fechanac'],
           'tel' => $_POST['tel'],
           'correo' => $_POST['correo'],
           'dir' => $_POST['dir'],
           'sexo' => $_POST['sexo'],
           'civil' => $_POST['civil'],
           'nompadre' => $_POST['nompadre'],
           'cedulapadre' => $_POST['cedulapadre'],
           'nommadre' => $_POST['nommadre'],
           'cedulamadre' => $_POST['cedulamadre'],
           'nomconyuge' => $_POST['nomconyuge'],
           'cedulaconyuge' => $_POST['cedulaconyuge'],
            'id' => $_POST['id']
        ];
        if ($modelo->ActualizarSeguromedico($objeto)) {     //-nombre del html solo primera letra en Mayuscula Actualizar + Gastosmedicos
            echo "<script> alert('Asegurado Actualizado'); </script>"; 

        } else {
            echo "<script> alert('Error al actualizar asegurado'); </script>";  
        }
    } elseif ($_REQUEST['opcion'] == 'eliminar') {
        if ($modelo->EliminarSeguromedico($_REQUEST['id'])) {  //-nombre del html solo primera letra en Mayuscula Eliminar + Gastosmedicos
            echo "<script> alert('Asegurado eliminado'); </script>";  
        } else {
            echo "<script> alert('Error al eliminar asegurado'); </script>"; 
        }
    }
}


//Debido a que una tabla de datos pudiera almacenar cienes de registros vamos a preparar nuesta pagina web
//para paginar y vamos a sumir como ejemplo que cada pagina presentara 3 registros por paginación
$limit=3;
$pag = isset($_GET['pagina']) ? intval($_GET['pagina']) : 0; //operador monareo 

$_SESSION['numpagina']=$pag;

if($pag){
    $start=($pag - 1) * $limit;
}else{
    $start=0;
}

//Fin del codigo que indica la cantidad de registros que se presentara por pagina y apartir de que registro en cada paginación

//Si se mando a buscar

if(isset($_POST['buscar'])){
        $texto = $_POST['texto'];
        $_SESSION['consulta'] = $_POST['texto'];

        if(empty($texto)){
            $seguromedico = $modelo->obtenerSeguromedicoPorRango($start,$limit);  //cambiar clientes por nombre de html "gastosmedicos"-segunda parte solo en Mayuscula y en blanco 
            $TotReg=$modelo->obtenerTotalRegistros();
        }
        else{
            $seguromedico = $modelo->obtenerSeguromedicoPorNombre($texto,$start,$limit); //cambiar clientes por nombre de html-segunda parte solo en Mayuscula
            $TotReg=$modelo->obtenerTotalRegistrosDeLaBusqueda($texto);
        }

        $TotPaginas = ceil($TotReg['Reg']/$limit) ;
}else{
    if(!isset($_SESSION['consulta']) || (isset($_SESSION['consulta']) && empty($_SESSION['consulta']))  ){
            $seguromedico= $modelo->obtenerSeguromedicoPorRango($start,$limit);  //cambiar clientes por nombre de html-segunda parte solo en Mayuscula
            $TotReg=$modelo->obtenerTotalRegistros();
    }else{
            $seguromedico = $modelo->obtenerSeguromedicoPorNombre($_SESSION['consulta'],$start,$limit);//cambiar clientes por nombre de html-segunda parte solo en Mayuscula
            $TotReg=$modelo->obtenerTotalRegistrosDeLaBusqueda($_SESSION['consulta']);
    }
    $TotPaginas = ceil($TotReg['Reg']/$limit);
}




include_once('../Vista/seguromedico.html');//cambiar gastosmedicos por el nombre de vista de este mismo

?>