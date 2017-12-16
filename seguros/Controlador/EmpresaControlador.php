<?php

if(empty($_SESSION['usuario'])){
    session_start();
}

require_once('../Modelo/EmpresaModelo.php');   //-Nombre del modelo de este tipo
$_SESSION['loguedo']=true;

$modelo = new EmpresaModelo(); //-Nombre del modelo de este tipo
//Variables de control para la edición de registro de cliente
$editargastosmedicos = false;  //-nombre de html de vista ejemplo editar + nombre del html
$editarid="";

if(isset($_POST['agregar'])){
    $obj = [                                         //-agregar todos los names del html sin agregar el "id"
           'empresa' => $_POST['empresa'],
           'noruc' => $_POST['noruc'],
           'representante' => $_POST['representante'],
           'noced' => $_POST['noced'],
           'email' => $_POST['email'],
           'direccion' => $_POST['direccion'],
           'negocio' => $_POST['negocio'],
           'aseguradora' => $_POST['aseguradora'],
           'otrosseguros' => $_POST['otrosseguros'],
           'requerimiento' => $_POST['requerimiento'],
           'cantidad' => $_POST['cantidad'],
           ];
        
    if($modelo->AgregarGastosmedicos($obj)){  //nombre del html solo primera letra en Mayuscula Agregar + Gastosmedicos
        echo "<script> alert('Asegurado Agregado'); </script>";  
    }else{
     echo "<script> alert('Error no se registro el asegurado en la base de datos'); </script>"; 
    }
}

if(isset($_REQUEST['opcion'])){
    
       
   if ($_REQUEST['opcion'] == 'editar') {

        $editargastosmedicos = true;   //-como html igual que linea 12 de este documento mismo nombre 
        $editarid = $_REQUEST['id'];

    } elseif ($_REQUEST['opcion'] == 'cancelar') {

        $editargastosmedicos = false; //-como html igual que linea 12 de este documento mismo nombre 
        $editarid = '';

    } elseif ($_REQUEST['opcion'] == 'guardar') {
        $editargastosmedicos = false;  //-como html igual que linea 12 de este documento mismo nombre 
        $editarid = '';

        $objeto = [                        //-copiar de aqui a bajo desde la linea 17 hasta ] dejando el id al final
           'empresa' => $_POST['empresa'],
           'noruc' => $_POST['noruc'],
           'representante' => $_POST['representante'],
           'noced' => $_POST['noced'],
           'email' => $_POST['email'],
           'direccion' => $_POST['direccion'],
           'negocio' => $_POST['negocio'],
           'aseguradora' => $_POST['aseguradora'],
           'otrosseguros' => $_POST['otrosseguros'],
           'requerimiento' => $_POST['requerimiento'],
           'cantidad' => $_POST['cantidad'],
            'id' => $_POST['id']
        ];
        if ($modelo->ActualizarGastosmedicos($objeto)) {     //-nombre del html solo primera letra en Mayuscula Actualizar + Gastosmedicos
            echo "<script> alert('Asegurado Actualizado'); </script>"; 

        } else {
            echo "<script> alert('Error al actualizar asegurado'); </script>";  
        }
    } elseif ($_REQUEST['opcion'] == 'eliminar') {
        if ($modelo->EliminarGastosmedicos($_REQUEST['id'])) {  //-nombre del html solo primera letra en Mayuscula Eliminar + Gastosmedicos
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
            $gastosmedicos = $modelo->obtenerGastosmedicosPorRango($start,$limit);  //cambiar clientes por nombre de html "gastosmedicos"-segunda parte solo en Mayuscula y en blanco 
            $TotReg=$modelo->obtenerTotalRegistros();
        }
        else{
            $gastosmedicos = $modelo->obtenerGastosmedicosPorNombre($texto,$start,$limit); //cambiar clientes por nombre de html-segunda parte solo en Mayuscula
            $TotReg=$modelo->obtenerTotalRegistrosDeLaBusqueda($texto);
        }

        $TotPaginas = ceil($TotReg['Reg']/$limit) ;
}else{
    if(!isset($_SESSION['consulta']) || (isset($_SESSION['consulta']) && empty($_SESSION['consulta']))  ){
            $gastosmedicos= $modelo->obtenerGastosmedicosPorRango($start,$limit);  //cambiar clientes por nombre de html-segunda parte solo en Mayuscula
            $TotReg=$modelo->obtenerTotalRegistros();
    }else{
            $gastosmedicos = $modelo->obtenerGastosmedicosPorNombre($_SESSION['consulta'],$start,$limit);//cambiar clientes por nombre de html-segunda parte solo en Mayuscula
            $TotReg=$modelo->obtenerTotalRegistrosDeLaBusqueda($_SESSION['consulta']);
    }
    $TotPaginas = ceil($TotReg['Reg']/$limit);
}




include_once('../Vista/gastosmedicos.html');//cambiar gastosmedicos por el nombre de vista de este mismo

?>