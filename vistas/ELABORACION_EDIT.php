<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ELABORACION_Model.php');
include_once ('../modelos/PRODUCTO_Model.php');

class Elaboracion_edit{

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

                <div class="alert alert-warning"><?php echo $literales['elaboracionMODIFY']?></div>

                <div class="form-group">
                    <label for="nombreB">Nombre actual:</label>
                    <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                            value="<?php  echo $row['nombre_elaboracion']?>">

                </div>

                <form role="form" action="ELABORACION_Controller.php?id=EDITELABORACION&ctr=ELABORACION" method="POST">

                    <input type="hidden" id="idElaboracionAModificar" name="idElaboracionAModificar" value="<?php echo $row['id_elaboracion']?>">

                    <div class="form-group">
                        <label for="controlador"><?php  echo $literales['seleccion producto']?></label>
                        <select id="nombreNuevo" name="nombreNuevo"style="width: 200px" class=" form-control" required>
                            <?php
                            $productos= Producto_modelo::listarProducto();
                            echo"<option selected value=''> </option>";
                            while($row = mysqli_fetch_assoc($productos)){
                                echo "<option value='".$row['id_producto']."' >".$row['nombre']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>"type="submit">
                        <a class="btn btn-default" href="ELABORACION_Controller.php?id=SHOWALLELABORACION&ctr=ELABORACION";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>