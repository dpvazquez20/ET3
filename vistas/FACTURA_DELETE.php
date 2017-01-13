<?php

if(!isset($_SESSION)){
    session_start();
}
class Factura_delete{

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

                <title><?php echo $literales['borrarFactura']?></title>
                <?php $resul = Factura_Model::getFactura($_GET['idFactura']);
                $row= mysqli_fetch_assoc($resul);
                ?>
               
                <div class="alert alert-danger"><?php echo $literales['facturaDELETE'] ?></div>
                <form role="form" action="FACTURA_Controller.php?id=DELETEFACTURA&ctr=FACTURA" method="POST">
                    <div class="form-group">
                      

                        <label for="controlador"><?php echo $literales['idFactura'] ?></label>
                        <input  type="text" class="form-control" id="id_factura" name="id_factura" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="accionB"><?php echo $literales['proveedor'] ?></label>
                        <input  type="text" class="form-control" id="id_proveedor" name="id_proveedor" readonly="readonly"
                                value="<?php  echo $row['id_proveedor']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB"><?php echo $literales['nif'] ?></label>
                        <input  type="text" class="form-control" id="NIF" name="NIF" readonly="readonly"
                                value="<?php  echo $row['NIF']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB"><?php echo $literales['fecha'] ?></label>
                        <input  type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                                value="<?php  echo $row['fecha']?>">
                    </div>

                    <div class="form-group">
                            <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                            <a class="btn btn-default" href="FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>