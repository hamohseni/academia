<?php 
    require ("header.php"); 
?>
<main class="container p-1">
        <?php
        if(isset($_POST["crear"])){
            if($_POST["grado"]==NULL | $_POST["curso"]==NULL){
    	        //Si el nombre esta vacío no haremos nada
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Para asignar un curso debe escoger el grado y el curso asociado.</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
    	        ';
            }else{
                $crear=mysqli_query($conectarbasededatos, "INSERT INTO curso_has_grado (cur_id, gra_id) VALUES ('".$_POST["curso"]."', '".$_POST["grado"]."');")or die(mysqli_error($conectarbasededatos));
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Se ha asignado correctamente el curso al grado</b></p></font>
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
                 <h1 class="h2">Asignar Curso a Grado</h1>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" id="signup" method="post" action="">
                    <table class="table table-borderless">
                        <thead>
                            <tr align="center">
                                <th scope="col">
                                    <select class="form-control" name="grado" >
                                    <option value="null">--Grado--</option>
                                    <?php
                                        $datos1 = mysqli_query($conectarbasededatos, "SELECT * FROM grado") or die(mysqli_error($conectarbasededatos));;
                                        while($row1 = mysqli_fetch_array($datos1)) {
                                    ?>
                                    <option value="<?php echo $row1["gra_id"]; ?>"><?php echo $row1["gra_nombre"]; ?></option>
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </th>
                            </tr>
                            <tr align="center">
                                <th scope="col">
                                    <select class="form-control" name="curso" >
                                    <option value="null">--Curso--</option>
                                    <?php
                                        $datos1 = mysqli_query($conectarbasededatos, "SELECT * FROM curso") or die(mysqli_error($conectarbasededatos));;
                                        while($row1 = mysqli_fetch_array($datos1)) {
                                    ?>
                                    <option value="<?php echo $row1["cur_id"]; ?>"><?php echo $row1["cur_nombre"]; ?></option>
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