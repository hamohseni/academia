<?php
    //incluimos el archivo que conectara a la base de datos
    require('config.php'); 
    require('checarsesion.php');
    $usuario=$_SESSION['usuario'];
    $existeuser = mysqli_query($conectarbasededatos, "CALL proc_con_persona_identificacion(".mysqli_real_escape_string($conectarbasededatos,$usuario).");") or die(mysqli_error($conectarbasededatos));
    //Si el usuario fue eliminado y aun tiene una sesion activa, borrar las sesiones y mandarlo al index
    if(!mysqlI_num_rows($existeuser)){
    	unset($_SESSION["sesion"]);
    	unset($_SESSION["usuario"]);
    	unset($_SESSION["contrasena"]);
    	session_unset();
    	session_destroy();
        $parametros_cookies = session_get_cookie_params(); 
        setcookie(session_name(),0,1,$parametros_cookies["path"]);
    	header("Location: ./");
    	exit();
    }
    mysqli_next_result($conectarbasededatos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Panel de Gesti&oacute;n Academica</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/index.css" type="text/css">
        <link rel="stylesheet" href="CSS/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="/"><i class="icon-globe"> </i>UNAL</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown" >
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-box"></i>
                                Comunicacion
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="">Redactar Mensaje</a>
                                <a class="dropdown-item" href="">Bandeja de Entrada</a>
                                <a class="dropdown-item" href="">Mensajes Enviados</a>
                                <a class="dropdown-item" href="">Mensajes Eliminados</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-users"></i>
                                Academia
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="">Aula</a>
                                <a class="dropdown-item" href="">Historial</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-compass"></i>
                                Matricula
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="">Matricula</a>
                                <a class="dropdown-item" href="">Ausencias</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-check"></i>
                                Transporte
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="">Ruta</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-shopping-cart"></i>
                                Tesoreria
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="venta.php">Recibo</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown active"">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-user"> </i>Hamed
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="informacion-personal.php">Mi Perfil</a>
                                <a class="dropdown-item" href="cuenta.php">Mi Cuenta</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/">Volver al Sitio</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="salir.php">Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
