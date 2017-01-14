<?php



if(!isset($_SESSION)){
    session_start();
}

include_once('../modelos/STOCK_PRODUCTO_Model.php');
include_once('../modelos/PRODUCTO_Model.php');

class Stock_producto_show{

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

                <title><?php echo $literales['detalleStock']; ?></title>

                <?php
                    $resul= Stock_producto_modelo::getStock($_GET['idStock']);
                    $row = mysqli_fetch_assoc($resul);
                    $producto = Producto_modelo::getProducto($row['id_producto']);
                    $rowAux= mysqli_fetch_assoc($producto);
                ?>
                <div class="alert alert-success"><?php echo $literales['stockSHOW']?></div>
                <form>

                    <div class="form-group">
                        <label for="idV"><?php echo $literales['stockId']; ?></label>
                        <input  type="text" class="form-control" id="idV" name="idV" readonly="readonly"
                                value="<?php echo $rowAux['nombre']?>">
                    </div>

                    <div class="form-group">
                        <label for="costeV"><?php echo $literales['stockcoste']; ?></label>
                        <input  type="text" class="form-control" id="costeV" name="costeV" readonly="readonly"
                                value="<?php echo $row['coste']?>">
                    </div>

                    <div class="form-group">
                        <label for="fechaV"><?php echo $literales['stockfecha']; ?></label>
                        <input type="text" class="form-control" id="fechaV" name="fechaV" readonly="readonly"
                               value="<?php echo $row['fecha']?>">
                    </div>


                    <div class="form-group">
                        <a class="btn btn-default"href="STOCK_PRODUCTO_Controller.php?id=SHOWALLSTOCK_PRODUCTO&ctr=STOCK_PRODUCTO"><?php echo $literales['volverStock'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>