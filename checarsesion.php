<?php
    //Inicia la sesión
    session_start();
    
    //Cache tipo privado
    session_cache_limiter('private');

    session_cache_expire(10);

    //Si el usuario no tiene una alguna de las cuatro sesionas más importantes, eliminar todas las otras sesiones y redirecccionarlo al index
    if($_SESSION['sesion'] == NULL|$_SESSION['sesion'] != "INICIADA"|$_SESSION['usuario'] == NULL|$_SESSION['contrasena'] == NULL){
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

    //Definimos los datos para poder caducar la sesión
    //Datos sobre Ultimo Acceso
    $ultimoacceso = $_SESSION["ultimoacceso"];
    $tiempoactual = date("d-m-Y H:i:s");
    $tiempotranscurrido = (strtotime($tiempoactual)-strtotime($ultimoacceso));

    //Si aun tiene la sesión de ultimo acceso y ya pasaron 10 minutos de inactividad, redirigirlo a la página de salir, donde ahi se eliminarán todas las sesiones.
    if(($_SESSION["ultimoacceso"] != NULL) && ($tiempotranscurrido > 600)) {
        header("Location: salir.php?razon=sesion-caducada");
        exit();
    }
    //Si tiene la sesion de último acceso, volver a establecer el contador la sesión en 0 para que cuando llegue a 600 se caduque (se actualizara cada que el usuario entre a una página)
    if($_SESSION["ultimoacceso"] != NULL){
        $_SESSION["ultimoacceso"]= date("d-m-Y H:i:s");
    }
?>