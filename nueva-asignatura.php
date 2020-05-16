<?php 
    require ("header.php"); 
    $query = mysqli_query($conectarbasededatos, "CALL proc_con_persona_has_permiso_permiso($usuario,3)") or die(mysqli_error($conectarbasededatos));
    $row = mysqli_fetch_array($query);
    if($row["per_perm_estado"]==1){
?>
<main class="container p-1">
        <?php
        if(isset($_POST["crear"])){
            if($_POST["asignatura"]==NULL | $_POST["materia"]==NULL | $_POST["rotativo"]==NULL ){
    	        //Si el nombre esta vacío no haremos nada
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Para crear una materia debes rellenar la materia y el nombre de la asignatura.</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
    	        ';
            }else{
                mysqli_next_result($conectarbasededatos);
                $crear=mysqli_query($conectarbasededatos, "CALL proc_ins_asignatura('".$_POST["materia"]."','".$_POST["asignatura"]."','".$_POST["rotativo"]."');")or die(mysqli_error($conectarbasededatos));
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Se ha creado correctamente la asignatura</b></p></font>
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
                 <h1 class="h2">Crear Asignatura</h1>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" id="signup" method="post" action="">
                    <table class="table table-borderless">
                        <thead>
                            <tr align="center">
                                <th scope="col">
                                    <select class="form-control" name="materia" >
                                    <option value="NULL">--Materia--</option>
                                    <?php
                                        mysqli_next_result($conectarbasededatos);
                                        $datos1 = mysqli_query($conectarbasededatos, "CALL proc_con_materia_order();") or die(mysqli_error($conectarbasededatos));
                                        while($row1 = mysqli_fetch_array($datos1)) {
                                    ?>
                                    <option value="<?php echo $row1["mat_id"]; ?>"><?php echo $row1["mat_nombre"]; ?></option>
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        
                    </table>
                    <div class="form-group">
                        <input class="form-control" type="text" name="asignatura" placeholder="Nombre"/>
                        </div>
                    <table class="table table-borderless">
                        <thead>
                            <tr align="center">
                                <th scope="col">
                                    <select class="form-control" name="rotativo" >
                                        <option value="NULL">--Rotativo--</option>
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
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
<?php
    }else{
        echo '<meta http-equiv="refresh" content="0; url=error.php">';
    }
?>