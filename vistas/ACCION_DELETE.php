<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/ACCION_Model.php');
class Accion_delete{

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
                $resul= Accion_modelo::getAccion($_GET['nombreControlador']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-danger"><?php echo $literales['accionDELETE']?></div>

                <form role="form" action="ACCION_Controller.php?id=DELETEACCION&ctr=ACCION" method="POST">
                    <div class="form-group">
                        <label for="nombreB">Nombre</label>
                        <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                                value="<?php  echo $row['nombre']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="ACCION_Controller.php?id=SHOWALLACCION&ctr=ACCION";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>