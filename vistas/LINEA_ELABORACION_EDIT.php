<?php

if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/LINEA_ELABORACION_Model.php');
include_once ('../modelos/PRODUCTO_Model.php');
include_once ('../modelos/MATERIAL_Model.php');

class Linea_Elaboracion_edit{

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

                <title><?php echo $literales['EDIT']; ?></title>
                <?php
                    $resul4 = Linea_elaboracion_modelo::getLineaElaboracion($_GET['idLineaElaboracion']);
                    $row2 = mysqli_fetch_assoc($resul4);
                    $materialActual= Material_modelo::getMaterial($row2['id_material']);
                    $camposActualesMaterial = mysqli_fetch_assoc($materialActual);
                ?>

                <div class="alert alert-warning"><?php echo $literales['lineaEDIT']?></div>

                <form role="form" action="ELABORACION_Controller.php?id=EDITLINEAELABORACION&ctr=ELABORACION&idElaboracion=<?php echo $_GET['idElaboracion'];?>" method="POST">

                    <input type="hidden" class="form-control" id="idM" name="idM"
                           value="<?php echo $row2['id_linea_elaboracion']?>">

                    <div class="form-group">
                        <label for="materialM"><?php echo $literales['nombre']; ?></label>
                        <select name="materialM" id="materialM" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Material_modelo::listarMateriales();?>
                            <?php while($material = mysqli_fetch_assoc($resul)) { ?>
                                <?php if ($camposActualesMaterial['id']==$material['id']) {?>
                                    <option selected value="<?php echo $material["id"] ?>"><?= $material["nombre"] ?></option>

                                <?php } else {
                                    ?>
                                    <option value="<?php echo $material["id"] ?>"><?= $material["nombre"] ?></option>
                                <?php }
                            }?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="cantidadM"><?php echo $literales['cantidad']; ?></label>
                        <input type="text" class="form-control" id="cantidadM" name="cantidadM" min="1"
                               value="<?php echo $row2['cantidad']?>">
                    </div>



                    <div class="form-group">
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
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