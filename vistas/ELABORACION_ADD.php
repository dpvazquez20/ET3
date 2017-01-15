<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PRODUCTO_Model.php');
class Elaboracion_add
{

    function __construct()
    {
        $this->render();
    }

    function render()
    {
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include('menu.php'); ?>
            <!-- Título de la página -->
            <div class="col-sm-9">
                <div class="alert alert-info"><?php echo $literales['elaboracionADD'] ?> </div>

                <form role="form" action="ELABORACION_Controller.php?id=ADDELABORACION&ctr=ELABORACION" method="POST">
                    <div class="form-group">
                        <label for="controlador"><?php  echo $literales['seleccion producto ADD']?></label>

                        <select id="elaboracion" name="elaboracion"style="width: 200px" class=" form-control" required>
                            <?php
                            $productos= Producto_modelo::listarProducto();
                            echo"<option selected value=''> </option>";
                            while($row = mysqli_fetch_assoc($productos)){
                                echo "<option value='".$row['nombre']."' >".$row['nombre']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary" value="Enviar" type="submit">
                            <a class="btn btn-default" href="ELABORACION_Controller.php?id=SHOWALLELABORACION&ctr=ELABORACION"><?php echo $literales['cancelar']; ?></a>
                        </div>
                </form>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>