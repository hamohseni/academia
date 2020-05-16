<?php 
    require ("header.php"); 
    $query = mysqli_query($conectarbasededatos, "CALL proc_con_persona_has_permiso_permiso($usuario,4)") or die(mysqli_error($conectarbasededatos));
    $row = mysqli_fetch_array($query);
    if($row["per_perm_estado"]==1){
?>
<main class="container p-1">
        <?php
        if(isset($_POST["crear"])){
            if($_POST["curso"]==NULL){
    	        //Si el nombre esta vacío no haremos nada
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Para crear un curso debe rellenar el grado y el nombre del curso.</b></p></font>
                	       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	           <span aria-hidden="true">&times;</span>
                	       </button>
                        </div>
    	        ';
            }else{
                mysqli_next_result($conectarbasededatos);
                $crear=mysqli_query($conectarbasededatos, "CALL proc_ins_curso('".$_POST["curso"]."');")or die(mysqli_error($conectarbasededatos));
    	        echo'
    	                <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert">
                	       <font color="#338AFF"><p><b>Se ha creado correctamente el curso</b></p></font>
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
                 <h1 class="h2">Crear Curso</h1>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" id="signup" method="post" action="">
                    <div class="form-group">
                        <input class="form-control" type="text" name="curso" placeholder="Nombre" autofocus />
                    </div>
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