<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PROVEEDOR_Model.php');
class Proveedor_edit{

    function __construct(){
        $this->render();
    }

    //Vista/formulario para modificar los datos un proveedor. Los datos
    //incluyendo el nombre, nif, correo electronico, dirección
    //codigo postal, ciudad y provincia

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
                        <label for="nombreM"><?php echo $literales['nombre']?></label>
                        <input type="text" class="form-control" id="nombreM" name="nombreM" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                               value="<?php echo $row['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="NIFM">NIF</label>
                        <input type="text" class="form-control" id="NIFM" name="NIFM" required pattern="(([A-Z]{1})([0-9]{8}))"
                               value="<?php echo $row['nif']?>">
                    </div>
                    <div class="form-group">
                        <label for="correoEM"><?php echo $literales['correo electronico']?></label>
                        <input type="email" class="form-control" id="correoEM" name="correoEM"
                               value="<?php echo $row['correo_electronico']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="telefonoM"><?php echo $literales['telefono']?></label>
                        <input type="tel" class="form-control" id="telefonoM" name="telefonoM" required pattern="[0-9]{9}"
                               value="<?php echo $row['telefono']?>">
                    </div>
                    <div class="form-group">
                        <label for="direccionM"><?php echo $literales['direccion']?></label>
                        <input type="text" class="form-control" id="direccionM" name="direccionM" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                               value="<?php echo $row['direccion']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="codigoPM"><?php echo $literales['codigo postal']?></label>
                        <input type="text" class="form-control" id="codigoPM" name="codigoPM" size="5" maxlength="5" pattern="[0-9]{5}"
                               value="<?php echo $row['codigo_postal']?>">
                    </div>
                    <div class="form-group">
                        <label for="ciudadM"><?php echo $literales['ciudad']?></label>
                        <input type="text" class="form-control" id="ciudadM" name="ciudadM" required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                               value="<?php echo $row['ciudad']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="provinciaM"><?php echo $literales['provinca']?></label>
                        <input type="text" class="form-control" id="provinciaM" name="provinciaM" required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
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