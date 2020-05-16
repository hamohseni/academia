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
                    <th><a class="btn btn-primary btn-block" href="nuevo-grado.php" style="width: 180px; ">Nuevo Grado</a></th>
                    <th><a class="btn btn-primary btn-block" href="nuevo-curso.php" style="width: 180px; ">Nuevo Curso</a></th>
                    <th><a class="btn btn-primary btn-block" href="busqueda.php?bus=materia" style="width: 170px;">Busqueda</a></th>
                </tr>
            </thead>
        </table>

        <?php
            if(isset($_POST["editar"]) && isset($_POST['idgrad'])){
                $gradid_array = $_POST['idgrad'];
                foreach($gradid_array as $gradid)
                $result = mysqli_query($conectarbasededatos, "SELECT * FROM grado WHERE gra_id='$gradid'") or die(mysqli_error($conectarbasededatos));
        ?>
        <form method="post" action="">
        <?php
                while($row = mysqli_fetch_assoc($result)) { 
        ?>
            
            <table  class="table table-bordered table-fixed">
                <thead class="table-success">
                    <tr>
                        <th>Grado:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="nombre" value="<?php echo $row["gra_nombre"]; ?>" />
                        </td>
                        <td align="center">
                            <input class="btn btn-success btn-block" style="width:80px;" type="submit" name="guardar" value="Guardar">
                        </td>
                    </tr>
                </tbody>
            </tablet>    

                <input type="hidden" name="idg" value="<?php echo $row["gra_id"];?>">
                <input type="hidden" name="nmed" value="<?php echo $row["gra_nombre"];?>">
            
        <?php
                }
        ?>
        </form>
        <?php
            }if(isset($_POST["guardar"])){
                $edid = $_POST['idg'];
                $guardar = mysqli_query($conectarbasededatos, "UPDATE grado SET  gra_nombre='$_POST[nombre]' WHERE gra_id = '$edid'") or die(mysqli_error($conectarbasededatos));
                echo'
                        <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Se han guardado los cambios correctamente.</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
                    ';
                }if(isset($_POST["eliminar"]) && isset($_POST['idgra'])){
                    $matid_array = $_POST['idgra'];
                    foreach($matid_array as $eliminarid) {
                    $result = mysqli_query($conectarbasededatos, "DELETE FROM grado WHERE gra_id='$eliminarid'") or die(mysqli_error($conectarbasededatos));
            	     echo'
            	            <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                    	       <font color="#338AFF"><p><b>Se han eliminado correctamente los grados seleccionados.</b></p></font>
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
                        <th>Grado:</th>
                        <th>Curso:</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $datos = mysqli_query($conectarbasededatos, "SELECT * FROM grado ORDER BY gra_id") or die(mysqli_error($conectarbasededatos));
                    while($row = mysqli_fetch_array($datos)) {
                ?>
                    <tr>
                        <td width="20px"><input type="checkbox" name="idgra[]" value="<?php echo $row["gra_id"]; ?>" /></td>
                        <td><?php echo $row["gra_nombre"]; ?></td>
                        <td></td>
                        <td align="center">
                            <input class="btn btn-success btn-block" type="submit" name="editar" value="Editar" style="width:65px;" /> 
                        </td>
                    </tr>
                    <?php 
                            $var = $row["gra_id"];
                            $datos1= mysqli_query($conectarbasededatos, "SELECT * from curso WHERE gra_id='$var'");
                            while ($row1=mysqli_fetch_array($datos1)) { 
                        ?>
                    <tr> 
                        <td></td>
                        <td></td>
                        <td>
                            <?php echo $row1["cur_nombre"]; ?>
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