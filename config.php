<?php 
    //Inician los datos de conexi�n hacia la base de datos
    $host = "localhost"; //Servidor de la Base de Datos
    $usuario = "root"; //Usuario de la Base de Datos
    $contrasena = ""; //Contrasena de la Base de Datos
    $basededatos = "academia"; //Nombre de la Base de Datos
    //Crear conexi�n hacia la base de datos 
    $conectarbasededatos = mysqli_connect($host,$usuario,$contrasena);
    mysqli_select_db($conectarbasededatos,"$basededatos"); 
?>