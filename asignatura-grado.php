<?php 
    require("header.php"); 
?>
<main class="container p-1">
        <?php
        if(isset($_POST["crear"])){
            if($_POST["asignatura"]==NULL | $_POST["grado"]==NULL ){
    	        //Si el nombre esta vacío no haremos nadaj
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Para crear una materia debes rellenar la materia y el nombre de la asignatura.</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
    	        ';
            }else{
                $crear=mysqli_query($conectarbasededatos, "CALL proc_ins_grado_has_asignatura(".$_POST["asignatura"]."', '".$_POST["grado"]."');")or die(mysqli_error($conectarbasededatos));
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Se ha asignado correctamente la asignatura al grado</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
    	            ';
            }
        }
        ?>
<div id="signup" class="row">
    <div class="col-md-4 mx-auto">
        <div class="card mt-1 text-center">
            <div class="card-header">
                 <h1 class="h2">Asignar Asignatura a Grado</h1>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" id="signup" method="post" action="">
                    <table class="table table-borderless">
                        <thead>
                            <tr align="center">
                                <th scope="col">
                                    <select class="form-control" name="asignatura" >
                                    <option value="NULL">--Asignatura--</option>
                                    <?php
                                        mysqli_next_result($conectarbasededatos);
                                        $datos1 = mysqli_query($conectarbasededatos, "CALL proc_con_asignatura_order();") or die(mysqli_error($conectarbasededatos));
                                        while($row1 = mysqli_fetch_array($datos1)) {
                                    ?>
                                    <option value="<?php echo $row1["asi_id"]; ?>"><?php echo $row1["asi_nombre"]; ?></option>
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </th>
                            </tr>
                            <tr align="center">
                                <th scope="col">
                                    <select class="form-control" name="grado" >
                                    <option value="NULL">--Grado--</option>
                                    <?php
                                        mysqli_next_result($conectarbasededatos);
                                        $datos1 = mysqli_query($conectarbasededatos, "CALL proc_con_grado_order();") or die(mysqli_error($conectarbasededatos));;
                                        while($row1 = mysqli_fetch_array($datos1)) {
                                    ?>
                                    <option value="<?php echo $row1["gra_id"]; ?>"><?php echo $row1["gra_nombre"]; ?></option>
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <br>
                    <input class="btn btn-primary btn-block"  id="submit" type="submit" name="crear" value="Crear"></p>
                </form>
            </div>
        </div>
    </div>
</div>
</main>