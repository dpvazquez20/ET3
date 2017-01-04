<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PROVEEDOR_Model.php');
class Proveedor_edit{

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
                <?php $resul = Proveedor_modelo::getProveedor($_GET['idProveedor']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-warning"><?php echo $literales['proveedorEDIT']?></div>
                <form role="form" action="PROVEEDOR_Controller.php?id=EDITPROVEEDOR&ctr=PROVEEDOR" method="POST">

                    <input type="hidden" class="form-control" id="id_proveedor" name="id_proveedor"
                           value="<?php echo $row['id']?>">
                    <div class="form-group">
                        <label for="nombreM">Nombre</label>
                        <input type="text" class="form-control" id="nombreM" name="nombreM" required
                               value="<?php echo $row['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="NIFM">DNI</label>
                        <input type="text" class="form-control" id="NIFM" name="NIFM" required pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                               value="<?php echo $row['nif']?>">
                    </div>
                    <div class="form-group">
                        <label for="correoEM">Correo Electronico</label>
                        <input type="text" class="form-control" id="correoEM" name="correoEM"
                               value="<?php echo $row['correo_electronico']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="telefonoM">Telefono</label>
                        <input type="text" class="form-control" id="telefonoM" name="telefonoM"
                               value="<?php echo $row['telefono']?>">
                    </div>
                    <div class="form-group">
                        <label for="direccionM">Dirección</label>
                        <input type="text" class="form-control" id="direccionM" name="direccionM"
                               value="<?php echo $row['direccion']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="codigoPM">Código Postal</label>
                        <input type="text" class="form-control" id="codigoPM" name="codigoPM"
                               value="<?php echo $row['codigo_postal']?>">
                    </div>
                    <div class="form-group">
                        <label for="ciudadM">Ciudad</label>
                        <input type="text" class="form-control" id="ciudadM" name="ciudadM"
                               value="<?php echo $row['ciudad']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="provinciaM">Provincia</label>
                        <input type="text" class="form-control" id="provinciaM" name="provinciaM"
                               value="<?php echo $row['provincia']?>">
                    </div>
                    <div class="form-group">
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                        <a class="btn btn-default" href="../controladores/PROVEEDOR_Controller.php?id=SHOWALLPROVEEDOR&ctr=PROVEEDOR";"><?php echo $literales['volver'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>