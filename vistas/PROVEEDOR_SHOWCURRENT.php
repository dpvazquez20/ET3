<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PROVEEDOR_Model.php');
class Proveedor_show{

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

                <title><?php echo $literales['mostrar proveedor']; ?></title>

                <?php
                $resul = Proveedor_modelo::getProveedor($_GET['idProveedor']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['proveedorSHOW']?></div>
                <form>
                    <div class="form-group">
                        <label for="nombreS">Nombre</label>
                        <input type="text" class="form-control" id="nombreS" name="nombreS" readonly="readonly"
                               value="<?php echo $row['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="NIFS">NIF</label>
                        <input type="text" class="form-control" id="NIFS" name="NIFS" readonly="readonly"
                               value="<?php echo $row['nif']?>">
                    </div>
                    <div class="form-group">
                        <label for="correoES">Correo Electronico</label>
                        <input type="text" class="form-control" id="correoES" name="correoES" readonly="readonly"
                               value="<?php echo $row['correo_electronico']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="telefonoS">Telefono</label>
                        <input type="text" class="form-control" id="telefonoS" name="telefonoS" readonly="readonly"
                               value="<?php echo $row['telefono']?>">
                    </div>
                    <div class="form-group">
                        <label for="direccionS">Dirección</label>
                        <input type="text" class="form-control" id="direccionS" name="direccionS" readonly="readonly"
                               value="<?php echo $row['direccion']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="codigoPS">Código Postal</label>
                        <input type="text" class="form-control" id="codigoPS" name="codigoPS" readonly="readonly"
                               value="<?php echo $row['codigo_postal']?>">
                    </div>
                    <div class="form-group">
                        <label for="ciudadS">Ciudad</label>
                        <input type="text" class="form-control" id="ciudadS" name="ciudadS" readonly="readonly"
                               value="<?php echo $row['ciudad']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="provinciaS">Provincia</label>
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