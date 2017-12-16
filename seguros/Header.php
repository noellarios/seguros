<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="./Estilo/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link href="./Estilo/CssPropia/Estilo.css" rel="stylesheet" media="screen"/>
    <title>Inicio</title>
    
</head>
<body class="Fondo">
<?php
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']));
    //var_dump($host) . var_dump($uri);
?>
<header>
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <!-- Inicia menu-->
            <div class="collapse navbar-collapse pull-right">
                <ul class="nav navbar-nav">
                    <li class="nav-item active"><a href="<?php
                    
                    if($uri=="/PHP/seguros"){
                        echo "./index.php";

                    }
                    elseif($uri=="/PHP/seguros/Controlador"){
                        echo "../index.php";

                    }
                        ?>" class="glyphicon glyphicon-home pull-left"> Inicio</a></li>
                    <?php
                    if($_SESSION['logueado']){
                        if($uri=="/PHP/seguros"){
                            echo '<li><a href="./Logout.php" class="glyphicon glyphicon-log-out">Logout</a></li>';
                            echo '<li><a href="./Controlador/EmpresaControlador.php" class="glyphicon glyphicon-edit"> Gastos-Medicos </a></li>';
                            echo '<li><a href="./Controlador/IncendiosControlador.php" class="glyphicon glyphicon-edit"> Incendios </a></li>';
                            echo '<li><a href="./Controlador/MedicoControlador.php" class="glyphicon glyphicon-edit"> Medico </a></li>';
                            echo '<li><a href="./Controlador/ProveedoresControlador.php" class="glyphicon glyphicon-edit"> Proveedores </a></li>';
                        }            
                        elseif($uri=="/PHP/seguros/Controlador"){
                            echo '<li><a href="../Logout.php" class="glyphicon glyphicon-log-out">Logout</a></li>';
                            echo '<li><a href="../Controlador/EmpresaControlador.php" class="glyphicon glyphicon-edit"> Gastos-Medicos</a></li>';
                            echo '<li><a href="../Controlador/IncendiosControlador.php" class="glyphicon glyphicon-edit"> Incendios</a></li>';
                            echo '<li><a href="../Controlador/MedicoControlador.php" class="glyphicon glyphicon-edit"> Medico </a></li>';
                            echo '<li><a href="../Controlador/ProveedoresControlador.php" class="glyphicon glyphicon-edit"> Proveedores </a></li>';
                        } 
                    }else{
                        if($uri=="/PHP/seguros"){
                            echo '<li><a href="./Controlador/LoginControlador.php" class="glyphicon glyphicon-user"> Login</a></li>';
                            echo '<li><a href="./Controlador/RegistrarseControlador.php" class="glyphicon glyphicon-edit"> Registrarse</a></li>';
                        }
                        elseif($uri=="/PHP/seguros/Controlador"){
                            echo '<li><a href="../Controlador/LoginControlador.php" class="glyphicon glyphicon-user"> Login</a></li>';
                            echo '<li><a href="../Controlador/RegistrarseControlador.php" class="glyphicon glyphicon-edit"> Registrarse</a></li>';
                        }  
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
</header>
</body>
</html>
