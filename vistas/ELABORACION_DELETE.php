<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
include_once('../modelos/ELABORACION_Model.php');
class Elaboracion_delete{

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
                $resul= Elaboracion_modelo::getElaboracionID($_GET['idElaboracion']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-danger"><?php echo $literales['elaboracionDELETE']?></div>

                <form role="form" action="ELABORACION_Controller.php?id=DELETEELABORACION&ctr=ELABORACION" method="POST">
                    <div class="form-group">
                        <input type="hidden" id="elaboracionAEliminar" name="elaboracionAEliminar" value="<?php echo $row['id_elaboracion']?>">
                        <label for="nombreB"><?php echo $literales['nombre'] ?></label>
                        <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                                value="<?php  echo($row['nombre_elaboracion'])?>">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="ELABORACION_Controller.php?id=SHOWALLELABORACION&ctr=ELABORACION";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>
                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>
