<?php 
    require ("header.php");
?>
<main class="container p-5">
    <div class="table-responsive jumbotron">
        <h2>Materias actuales:</h2>
        <table class="table table-borderless">
            <thead>
                <tr align="center">
                    <th style="width:400px;"></th>
                    <th style="width:400px;"></th>
                    <th><a class="btn btn-primary btn-block" href="nueva-materia.php" style="width: 180px; ">Nueva Materia</a></th>
                    <th><a class="btn btn-primary btn-block" href="nueva-asignatura.php" style="width: 180px; ">Nueva Asignatura</a></th>
                    <th><a class="btn btn-primary btn-block" href="busqueda.php?bus=materia" style="width: 170px;">Busqueda</a></th>
                </tr>
            </thead>
        </table>

        <?php
            if(isset($_POST["editar"]) && isset($_POST['idmat'])){
                $matid_array = $_POST['idmat'];
                foreach($matid_array as $matid)
                $result = mysqli_query($conectarbasededatos, "CALL proc_con_materia($matid)") or die(mysqli_error($conectarbasededatos));
        ?>
        <form method="post" action="">
        <?php
                while($row = mysqli_fetch_assoc($result)) { 
        ?>
            
            <table  class="table table-bordered table-fixed">
                <thead class="table-success">
                    <tr>
                        <th>Nombre:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="nombre" value="<?php echo $row["mat_nombre"]; ?>" />
                        </td>
                        <td align="center">
                            <input class="btn btn-success btn-block" style="width:80px;" type="submit" name="guardar" value="Guardar">
                        </td>
                    </tr>
                </tbody>
            </tablet>    

                <input type="hidden" name="idm" value="<?php echo $row["mat_id"];?>">
                <input type="hidden" name="nmed" value="<?php echo $row["mat_nombre"];?>">
            
        <?php
                }
        ?>
        </form>
        <?php
            }if(isset($_POST["guardar"])){
                $edid = $_POST['idm'];
                $guardar = mysqli_query($conectarbasededatos, "UPDATE materia SET  mat_nombre='$_POST[nombre]' WHERE mat_id = '$edid'") or die(mysqli_error($conectarbasededatos));
                echo'
                        <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Se han guardado los cambios correctamente.</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
                    ';
                }if(isset($_POST["eliminar"]) && isset($_POST['idmat'])){
                    $matid_array = $_POST['idmat'];
                    foreach($matid_array as $eliminarid) {
                    $result = mysqli_query($conectarbasededatos, "DELETE FROM materia WHERE mat_id='$eliminarid'") or die(mysqli_error($conectarbasededatos));
            	     echo'
            	            <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                    	       <font color="#338AFF"><p><b>Se han eliminado correctamente los Productos seleccionados.</b></p></font>
                    	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    	           <span aria-hidden="true">&times;</span>
                    	       </button>
                            </div>
              	        ';
                }
        
            }
        ?>
        <form method="post" action="">
            <table class="table table-bordered table-fixed table-hover">
                <thead class="table-primary">
                    <tr>
                        <th width="20px">#</th>
                        <th>Materia:</th>
                        <th>Asignatura</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $datos = mysqli_query($conectarbasededatos, "CALL proc_con_materia_order") or die(mysqli_error($conectarbasededatos));
                    while($row = mysqli_fetch_array($datos)) {
                ?>
                    <tr>
                        <td width="20px"><input type="checkbox" name="idmat[]" value="<?php echo $row["mat_id"]; ?>" /></td>
                        <td><?php echo $row["mat_nombre"]; ?></td>
                        <td></td>
                        <td align="center">
                            <input class="btn btn-success btn-block" type="submit" name="editar" value="Editar" style="width:65px;" /> 
                        </td>
                    </tr>
                    <?php 
                            mysqli_next_result($conectarbasededatos);
                            $var = $row["mat_id"];
                            $datos1= mysqli_query($conectarbasededatos, "CALL proc_con_asignatura($var)") or die(mysqli_error($conectarbasededatos));
                            while ($row1=mysqli_fetch_array($datos1)) { 
                        ?>
                    <tr> 
                        <td></td>
                        <td></td>
                        <td>
                            <?php echo $row1["asi_nombre"]; ?>
                        </td>
                        <td></td>
                    </tr>
                <?php
                            }
                    }
                ?>
                </tbody>
            </table>
            <table class="table table-borderless">
              <thead>
                <tr align="center">
                  <th scope="col"><input class="btn btn-danger btn-block" type="submit" name="eliminar" value="Eliminar Seleccionados" style="width:190px;"/></th>
              </thead>
            </table>
           
        </form>
        </p>
        </div>
    </div>
</main>