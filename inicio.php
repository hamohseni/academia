<?php 
    require("header.php"); 

    $query = mysqli_query($conectarbasededatos, "CALL proc_con_persona_has_permiso_permiso($usuario,1)") or die(mysqli_error($conectarbasededatos));
    $row = mysqli_fetch_array($query);
    if($row["per_perm_estado"]==1){
?>
    <main class="container p-4">
        
        <div id="home" class="jumbotron mt-4">
            <h1 class="display-4">Hola Nombre de Ingresado</h1>
            <br>
            <h3>Bienvenido al Panel de Control&#33;</h3>
            <h4>&#191;Que Deseas Hacer&#63;</h4>
        </div>
    <div class="table-responsive jumbotron">
        <div>
            <div class="container">
               <table class="table table-bordered table-fixed ">
                  <th class="table-success border-success"><h2><center>Informaci&oacute;n de Administraci&oacute;n</center></h2></th>
                </table>
              <br>
             
    </div>
</main>
<?php
    }else{
        echo '<meta http-equiv="refresh" content="0; url=error.php">';
    }
?>