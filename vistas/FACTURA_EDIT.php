<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/FACTURA_Model.php');
include_once ('../modelos/ALBARAN_Model.php');

class Factura_edit{

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
            <title><?php echo $literales['editarFactura'] ?></title>

             <script>
                    $( function() {
                        $( "#fecha" ).datepicker({dateFormat: "yy-mm-dd"});
                    } );
            </script>
                <?php
                $resul = Factura_model::getFactura($_GET['idFactura']);
                $factura = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['facturaEDIT'] ?></div>

                 <form role="form" action="FACTURA_Controller.php?id=EDITFACTURA&ctr=FACTURA" method="POST">

                  

                               <label for="idFactura"><?php echo $literales['idFactura'] ?></label>
                        <input  type="text" class="form-control" id="id_factura" name="id_factura" readonly="readonly"
                                value="<?php  echo $factura['id']?>">

                    <!-- Seleccion del proveedor-->
                    <div class="form-group">
                        <label for="proveedor"><?php  echo $literales['proveedor']?></label>
                        <select id="id_proveedor" name="id_proveedor"style="width: 200px" class=" form-control">
                            <?php
                            $proveedores= Factura_Model::listarProveedores();
                            while($row = mysqli_fetch_assoc($proveedores)){
                                $selected ="";
                                if($row['id']==$factura['id_proveedor']){
                                    $selected ='selected="selected"';
                                }
                                
                                echo "<option ".$selected." value='".$row['id']."' >".$row['nif']."</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="Nombre"><?php echo $literales['nif'] ?></label>
                        <input type="text" class="form-control" id="NIF" name="NIF" <?php echo 'value="'.$factura['NIF'].'"';?>  >
                    </div>

                <!-- Seleccion de la fecha-->
                    <div class="form-group">
                            <label for="fecha"><?php  echo $literales['fecha']?></label>
                            <input type="text" class="form-control" id="fecha" name="fecha" <?php echo 'value="'.$factura['fecha'].'"';?>>
                        </div>
                    <div class="form-group">
                            <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                            <a class="btn btn-default" href="../controladores/FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA";">&laquo; <?php echo $literales['volver'] ?></a>
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