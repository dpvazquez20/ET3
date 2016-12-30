<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
include_once('../modelos/PERMISO_Model.php');
class Permiso_delete{

    function __construct(){
        $this->render();
    }

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">
                <?php
                $resul= Permiso_modelo::getPermiso($_GET['idPermiso']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-danger"><?php echo $literales['permisoDELETE']?></div>



                <form role="form" action="PERMISO_Controller.php?id=DELETEPERMISO&ctr=PERMISO" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_permiso" name="id_permiso"
                               value="<?php echo $row['id_permiso']?>">

                        <label for="controladorB">Controlador</label>
                        <input  type="text" class="form-control" id="controladorB" name="controladorB" readonly="readonly"
                                value="<?php  echo $row['controlador']?>">
                    </div>
                    <div class="form-group">
                        <label for="accionB">Acción</label>
                        <input  type="text" class="form-control" id="accionB" name="accionB" readonly="readonly"
                                value="<?php  echo $row['accion']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB">Perfil</label>
                        <input  type="text" class="form-control" id="perfilB" name="perfilB" readonly="readonly"
                                value="<?php  echo $row['perfil']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="PERMISO_Controller.php?id=SHOWALLPERMISO&ctr=PERMISO";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>