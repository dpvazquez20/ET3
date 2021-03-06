<?php

require_once ('../modelos/FACTURA_Model.php');
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/PERFIL_Model.php');
if(!isset($_SESSION)){
    session_start();
}
class Factura_add{

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
            <title><?php echo $literales['añadirFactura']?></title>
            <script>
                    $( function() {
                        $( "#fecha" ).datepicker({dateFormat: "yy-mm-dd"});
                    } );
            </script>

                <div class="alert alert-info"><?php echo $literales['facturaADD']?></div>

                <form role="form" action="FACTURA_Controller.php?id=ADDFACTURA&ctr=FACTURA" method="POST">

                    <!-- Seleccion del pedido-->
                    <div class="form-group">
                        <label for="proveedor"><?php echo $literales['proveedor']?></label>
                        <select id="id_proveedor" name="id_proveedor"style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PROVEEDOR
                            $proveedores= Factura_Model::listarProveedores();
                            while($row = mysqli_fetch_assoc($proveedores)){
                                echo "<option value='".$row['id']."' >".$row['nif']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                <!-- Seleccion de la fecha-->
                <div class="form-group">
                        <label for="Nombre"><?php echo $literales['nif']?></label>
                        <input type="text" class="form-control" id="NIF" name="NIF" required placeholder="<?php echo $literales['ejemploNif']?>"
                             >
                    </div>
                    <div class="form-group">
                            <label for="fecha"><?php echo $literales['fecha']?></label>
                            <input type="text" class="form-control" required id="fecha" name="fecha" placeholder="<?php echo $literales['ejemploFecha']?>">
                        </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input id="enviar" name="enviar" class="btn btn-primary" value="Enviar" type="submit">
                            <a class="btn btn-default" href="FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA";">&laquo; <?php echo $literales['cancelar'];?></a>
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