<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/LINEA_ELABORACION_Model.php');
include_once ('../modelos/MATERIAL_Model.php');
class Linea_Elaboracion_delete{

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

                <title><?php echo $literales['eliminar linea de elaboracion']; ?></title>
                <?php
                    $resul2 = Linea_elaboracion_modelo::listarLineasElaboracion($_GET['idLineaElaboracion']);
                    $resul = Linea_elaboracion_modelo::getLineaElaboracion($_GET['idLineaElaboracion']);
                    $row2 = mysqli_fetch_assoc($resul);
                    $material= $row2['id_material'];
                    $materialCompleto=Material_modelo::getMaterial($material);
                    $row3= mysqli_fetch_assoc($materialCompleto);

                ?>

                <div class="alert alert-danger"><?php echo $literales['lineaDELETE']?></div>
                <form role="form" action="ELABORACION_Controller.php?id=DELETELINEAELABORACION&ctr=ELABORACION&idElaboracion=<?php echo $row2['id_elaboracion'];?>" method="POST">

                    <div class="form-group">
                        <label for="nombreE">Nombre Material</label>
                        <input type="text" class="form-control" id="nombreE" name="nombreE" readonly="readonly"
                               value="<?php echo $row3['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="CantidadE">Cantidad</label>
                        <input type="text" class="form-control" id="CantidadE" name="CantidadE" readonly="readonly"
                               value="<?php echo $row2['cantidad']?>">
                    </div>
                    <input type="hidden" class="form-control" id="idE" name="idE"
                           value="<?php echo $row2['id_linea_elaboracion']?>">

                    <div class="form-group">
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="ELABORACION_Controller.php?id=SHOWELABORACION&ctr=ELABORACION&idElaboracion=<?php echo $row2['id_elaboracion'];?>";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>