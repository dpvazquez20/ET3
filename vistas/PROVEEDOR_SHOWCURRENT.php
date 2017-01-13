<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PROVEEDOR_Model.php');
class Proveedor_show{

    function __construct(){
        $this->render();
    }

    //Vista/formulario para ver en detalle un proveedor. Los datos
    //incluyendo el nombre, nif, correo electronico, dirección
    //codigo postal, ciudad y provincia

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['mostrar proveedor']; ?></title>

                <?php
                $resul = Proveedor_modelo::getProveedor($_GET['idProveedor']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['proveedorSHOW']?></div>
                <form>
                    <div class="form-group">
                        <label for="nombreS"><?php echo $literales['nombre']?></label>
                        <input type="text" class="form-control" id="nombreS" name="nombreS" readonly="readonly"
                               value="<?php echo $row['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="NIFS">NIF</label>
                        <input type="text" class="form-control" id="NIFS" name="NIFS" readonly="readonly"
                               value="<?php echo $row['nif']?>">
                    </div>
                    <div class="form-group">
                        <label for="correoES"><?php echo $literales['correo electronico']?></label>
                        <input type="text" class="form-control" id="correoES" name="correoES" readonly="readonly"
                               value="<?php echo $row['correo_electronico']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="telefonoS"><?php echo $literales['telefono']?></label>
                        <input type="text" class="form-control" id="telefonoS" name="telefonoS" readonly="readonly"
                               value="<?php echo $row['telefono']?>">
                    </div>
                    <div class="form-group">
                        <label for="direccionS"><?php echo $literales['direccion']?></label>
                        <input type="text" class="form-control" id="direccionS" name="direccionS" readonly="readonly"
                               value="<?php echo $row['direccion']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="codigoPS"><?php echo $literales['codigo postal']?></label>
                        <input type="text" class="form-control" id="codigoPS" name="codigoPS" readonly="readonly"
                               value="<?php echo $row['codigo_postal']?>">
                    </div>
                    <div class="form-group">
                        <label for="ciudadS"><?php echo $literales['ciudad']?></label>
                        <input type="text" class="form-control" id="ciudadS" name="ciudadS" readonly="readonly"
                               value="<?php echo $row['ciudad']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="provinciaS"><?php echo $literales['provincia']?></label>
                        <input type="text" class="form-control" id="provinciaS" name="provinciaS" readonly="readonly"
                               value="<?php echo $row['provincia']?>">
                    </div>

                    <div class="form-group">
                        <a class="btn btn-default"href="PROVEEDOR_Controller.php?id=SHOWALLPROVEEDOR&ctr=PROVEEDOR""><?php echo $literales['volver'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>