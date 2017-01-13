<?php

if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/LINEA_PEDIDO_Model.php');
require_once ('../modelos/MATERIAL_Model.php');
class Linea_Pedido_show{

    function __construct(){
        $this->render();
    }

    //Vista para visualizar en detalle una linea de pedido. Los datos a
    //que aparecen son material, cantidad, estado, precio unitario
    //sin iva, y la iva

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['mostrar linea de pedido']; ?></title>

                <?php
                $resul = Linea_Pedido_modelo::getLineaPedido($_GET['idLineaPedido']);
                $row= mysqli_fetch_assoc($resul);

                $resulM = Material_modelo::getMaterial($row['id_material']);
                $row2= mysqli_fetch_assoc($resulM);

                ?>
                <div class="alert alert-success"><?php echo $literales['lineaSHOW']?></div>
                <form>
                    <div  style="align-items: center" class="form-group">
                        <label for="IDPedidoE"><?php echo $literales['id pedido']?></label>
                        <input type="text" class="form-control" id="IDPedidoE" name="IDPedidoE" readonly="readonly"
                               value="<?php echo $row['id_pedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="nombreE"><?php echo $literales['material']?></label>
                        <input type="text" class="form-control" id="nombreE" name="nombreE" readonly="readonly"
                               value="<?php echo $row2['nombre']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="cantidadE"><?php echo $literales['cantidad']?></label>
                        <input type="text" class="form-control" id="cantidad" name="cantidad" readonly="readonly"
                               value="<?php echo $row['cantidad']?>">
                    </div>
                    <div class="form-group">
                        <label for="estadoE"><?php echo $literales['estado']?></label>
                        <input type="text" class="form-control" id="estadoE" name="estadoE" readonly="readonly"
                               value="<?php echo $row['estado']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="precioE"><?php echo $literales['precio']?></label>
                        <input type="text" class="form-control" id="precioE" name="precioE" readonly="readonly"
                               value="<?php echo $row['precio']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="IVAE">IVA</label>
                        <input type="text" class="form-control" id="IVAE" name="IVAE" readonly="readonly"
                               value="<?php echo $row['IVA']?>">
                    </div>

                    <div class="form-group">
                        <a class="btn btn-default"href="PEDIDO_Controller.php?id=SHOWPEDIDO&ctr=PEDIDO&idPedido=<?php echo $row['id_pedido'];?>"">&laquo; Volver atrás</a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>