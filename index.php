<?php
    //Inicia la sesión
    session_start();
    session_cache_limiter('private');
    session_cache_expire(1);
    require("final.php");
    //Incluimos los datos de conexión
    require("config.php");
    //Revisamos si tiene una sesión iniciada, si es así, redirigirlo a el inicio
    if(isset($_SESSION['sesion']) == "INICIADA" && $_SESSION['usuario'] != NULL && $_SESSION['contrasena'] != NULL){
            header("Location: inicio.php");
            exit();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gestion Academica</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/index.css" type="text/css">
        <link rel="stylesheet" href="/CSS/style.css">
    </head>
    <body>
        <!--<header>
        	<div class="main">
                <img src="imgs/logo2.jpg" width="100%">
            </div>
        </header>
        <br />--><?php
            if (isset($_POST['ingresar'])) {
            	//Definimos la fecha de acceso para poder caducarla después de 10 minutos de inactividad
            	$_SESSION["ultimoacceso"] = date("d-m-Y H:i:s");
            	$usuario = strip_tags(substr($_POST['usuario'],0,32));
            	$tomarcontrasena = strip_tags(substr($_POST['contrasena'],0,32));
            	$contrasena = md5($tomarcontrasena);
            	$fecha = date("d-m-Y H:i:s");
            	$ip = $_SERVER['REMOTE_ADDR'];
            
            
            	//Función para comprobar si existe el usuario
            	$existeonoelusuario = mysqli_query($conectarbasededatos, "CALL proc_con_persona_identificacion('".mysqli_real_escape_string($conectarbasededatos,$usuario)."');") or die(mysqli_error($conectarbasededatos));
                //Función para comprobar los datos colocados
                mysqli_next_result($conectarbasededatos);
            	$comprobardatos = mysqli_query($conectarbasededatos, "CALL proc_con_persona_datosingreso('".mysqli_real_escape_string($conectarbasededatos,$usuario)."');") or die(mysqli_error($conectarbasededatos));
            	$checarcontrasena = mysqli_fetch_array($comprobardatos);
                //Checar si los datos están vacios
                if ($tomarcontrasena==NULL | $usuario==NULL) {
                	echo '
                	        <div class="col-md-4 mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	            <font color="#338AFF"><p><b>&#161;Debes escribir tu nombre usuario y contrase&ntilde;a para poder ingresar&#33;</b></p></font>
                	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	                <span aria-hidden="true">&times;</span>
                	           </button>
                            </div>
                         ';
                }
                //Checar si existe el usuario
            	else if(!mysqli_num_rows($existeonoelusuario)){
            		echo '
            		        <div class="col-md-4 mx-auto alert alert-primary alert-dismissible fade show" role="alert">
                	            <font color="#338AFF"><p><b>El nombre de usuario que colocaste no existe, verif&iacute;calo por favor.</b></p></font>
                	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	                <span aria-hidden="true">&times;</span>
                	           </button>
                            </div>
            		';
            	}else if($checarcontrasena['per_contrasena'] != $contrasena) {
        		    echo '
        		            <div class="col-md-4 mx-auto alert alert-warning alert-dismissible fade show" role="alert">
                	            <font color="#338AFF"><p><b>&#161;La contrase&ntilde;a es incorrecta! Verif&iacute;cala e int&eacute;ntalo de nuevo.</b></p></font>
                	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	                <span aria-hidden="true">&times;</span>
                	           </button>
                            </div>
        		    ';
        	    //Si todo es correcto, asignarle la sesión y darle acceso
        	    }else{
                    mysqli_next_result($conectarbasededatos);
        		    $query = mysqli_query($conectarbasededatos, "CALL proc_con_persona_crearsesion('".mysqli_real_escape_string($conectarbasededatos,$usuario)."')") or die(mysqli_error($conectarbasededatos));
            		$row = mysqli_fetch_array($query);
            		$_SESSION["sesion"] = "INICIADA";
            		$_SESSION["usuario"] = $row['per_identificacion'];
            		$_SESSION["contrasena"] = $row['per_contrasena'];
            		echo '
            		    <div class="col-md-4 mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	            <font color="#338AFF">
                	                <p>
                	                    <b>Ingresando... </b>
                	                    <a href="inicio" style="color:#FFF;">[Haz clic aqu&iacute; si tarda demasiado]</a>
                	                    <meta http-equiv="refresh" content="0; url=inicio.php">
                	                </p>
                	            </font>
                	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	                <span aria-hidden="true">&times;</span>
                	           </button>
                            </div>
        				';
        	    }
            }
        ?>
        <main class="container p-4">
        <div id="signin"class="row">
            <div class="col-md-4 mx-auto">
                <div class="card mt-4 text-center">
                    <div class="card-header">
                        <h1 class="h4">
                            Sign in
                        </h1>
                    </div>
                        <img class=" mx-auto d-block logo m-4" src="/imgs/logo2.jpg" alt="Logo">
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" autofocus />
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="contrasena" type="password" placeholder="Password" id="contrasena" />    
                            </div>  
                            
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" id="submit" type="submit" name="ingresar" value="SIGN IN">
                            </div>
                            
                            <!--<button class="btn btn-primary btn-block" id="submit" type="submit" name="ingresar" >
                                Signin
                            </button>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </main>
        
        
