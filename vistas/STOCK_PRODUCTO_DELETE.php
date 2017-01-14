<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/STOCK_PRODUCTO_Model.php');
include_once ('../modelos/PRODUCTO_Model.php');
class Stock_producto_delete{

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
                <title><?php echo $literales['borrarStock']; ?></title>
                <?php
                $resul= Stock_producto_modelo::getStock($_GET['idStock']);
                $row = mysqli_fetch_assoc($resul);
                $producto = Producto_modelo::getProducto($row['id_producto']);
                $rowAux= mysqli_fetch_assoc($producto);
                ?>


                <div class="alert alert-danger"><?php echo $literales['stockDELETE']?></div>

                <form role="form" action="STOCK_PRODUCTO_Controller.php?id=DELETESTOCK_PRODUCTO&ctr=STOCK_PRODUCTO" method="POST">

                    <div class="form-group">
                        <input  type="hidden" class="form-control" id="idB" name="idB" readonly="readonly"
                                value="<?php echo $row['id']?>">
                    </div>

                    <div style="align-items: center" class="form-group">
                        <label for="id_productoB"><?php echo $literales['stockId_id_producto']; ?></label>
                        <input  type="text" class="form-control" id="id_productoB" name="id_productoB" readonly="readonly"
                                value="<?php echo $rowAux['nombre']?>">
                    </div>

                    <div class="form-group">
                        <label for="costeB"><?php echo $literales['precio']; ?></label>
                        <input type="number" class="form-control" id="costeB" name="costeB" readonly="readonly"
                               value="<?php echo $row['coste']?>">
                    </div>

                    <?php//id_productoB =  fechaB     ?>
                    <div class="form-group">
                        <label for="fechaB"><?php echo $literales['stockfecha']; ?></label>
                        <input type="date" class="form-control" id="fechaB" name="fechaB" readonly="readonly"
                               value="<?php $row['fecha']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminarStock']?>"type="submit">
                        <a class="btn btn-default" href="STOCK_PRODUCTO_Controller.php?id=SHOWALLSTOCK_PRODUCTO&ctr=STOCK_PRODUCTO"> <?php echo $literales['cancelarStock'];?></a>
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
