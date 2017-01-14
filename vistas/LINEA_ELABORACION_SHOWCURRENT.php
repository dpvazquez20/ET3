<?php

if(!isset($_SESSION)){
    session_start();
}

include_once('../modelos/MATERIAL_Model.php');
include_once('../modelos/LINEA_ELABORACION_Model.php');

class Linea_elaboracion_show{

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

                <title><?php echo $literales['detalleMaterial']; ?></title>

                <?php
                    $resul2 = Linea_elaboracion_modelo::listarLineasElaboracion($_GET['idLineaElaboracion']);
                    $resul = Linea_elaboracion_modelo::getLineaElaboracion($_GET['idLineaElaboracion']);
                    $row2 = mysqli_fetch_assoc($resul);
                    $material= $row2['id_material'];
                    $materialCompleto=Material_modelo::getMaterial($material);
                    $row3= mysqli_fetch_assoc($materialCompleto);
                    $material = $row3['nombre'];
                ?>


                <div class="alert alert-success"><?php echo $literales['materialSHOW']?></div>
                <form>

                    <div class="form-group">
                        <label for="idB"><?php echo $literales['nombre']; ?></label>
                        <input  type="text" class="form-control" id="idB" name="idB" readonly="readonly"
                                value="<?php  echo $row3['nombre']?>">
                    </div>


                    <div class="form-group">
                        <label for="descripcionB"><?php echo $literales['cantidad']; ?></label>
                        <input type="text" class="form-control" id="descripcionB" name="descripcionB" readonly="readonly"
                               value="<?php echo $row2['cantidad']?>">
                    </div>

                    <a class="btn btn-default" href="ELABORACION_Controller.php?id=SHOWELABORACION&ctr=ELABORACION&idElaboracion=<?php echo $row2['id_elaboracion'];?>";">&laquo; <?php echo $literales['cancelar'];?></a>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>