<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/LINEA_PEDIDO_Model.php');
include_once ('../modelos/MATERIAL_Model.php');
class Linea_Pedido_delete{

    function __construct(){
        $this->render();
    }

    //Vista para borrar una linea de pedido. Los datos a
    //que aparecen son material, cantidad, estado, precio unitario
    //sin iva, y la iva

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['eliminar linea de pedido']; ?></title>
                <?php $resul = Linea_Pedido_modelo::getLineaPedido($_GET['idLineaPedido']);
                $row= mysqli_fetch_assoc($resul);

                $resulM = Material_modelo::getMaterial($row['id_material']);
                $row2= mysqli_fetch_assoc($resulM);

                ?>

                <div class="alert alert-danger"><?php echo $literales['lineaDELETE']?></div>
                <form role="form" action="PEDIDO_Controller.php?id=DELETELINEAPEDIDO&ctr=PEDIDO&idPedido=<?php echo $row['id_pedido'];?>" method="POST">
                    <div  style="align-items: center" class="form-group">
                        <label for="IDPedidoE">ID Pedido</label>
                        <input type="text" class="form-control" id="IDPedidoE" name="IDPedidoE" readonly="readonly"
                               value="<?php echo $row['id_pedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="nombreE"><?php echo $literales['material']?></label>
                        <input type="text" class="form-control" id="nombreE" name="nombreE" readonly="readonly"
                               value="<?php echo $row2['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="CantidadE"><?php echo $literales['cantidad']?></label>
                        <input type="text" class="form-control" id="CantidadE" name="CantidadE" readonly="readonly"
                               value="<?php echo $row['cantidad']?>">
                    </div>
                    <div class="form-group">
                        <label for="EstadoE"><?php echo $literales['estado']?></label>
                        <input type="text" class="form-control" id="EstadoE" name="EstadoE" readonly="readonly"
                               value="<?php echo $row['estado']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="PrecioE"><?php echo $literales['precio']?></label>
                        <input type="text" class="form-control" id="PrecioE" name="PrecioE" readonly="readonly"
                               value="<?php echo $row['precio']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="fecha">IVA</label>
                        <input type="text" class="form-control" id="IVAE" name="IVAE" readonly="readonly"
                               value="<?php echo $row['IVA']?>">
                    </div>

                    <input type="hidden" class="form-control" id="IDE" name="IDE"
                           value="<?php echo $row['id']?>">

                    <div class="form-group">
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="PEDIDO_Controller.php?id=SHOWPEDIDO&ctr=PEDIDO&idPedido=<?php echo $row['id_pedido'];?>";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>