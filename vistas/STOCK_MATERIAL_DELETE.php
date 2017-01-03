<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/STOCK_MATERIAL_Model.php');
class Stock_material_delete{

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
                $resul= Stock_material_modelo::getStock($_GET['idStock']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-danger"><?php echo $literales['stockDELETE']?></div>

                <form role="form" action="STOCK_MATERIAL_Controller.php?id=DELETESTOCK_MATERIAL&ctr=STOCK_MATERIAL" method="POST">
                    
                    <div class="form-group">
                        <label for="idB"><?php echo $literales['stockId']; ?></label>
                        <input  type="text" class="form-control" id="idB" name="idB" readonly="readonly"
                                value="<?php echo $row['id']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="id_materialB"><?php echo $literales['stockId_material']; ?></label>
                        <input  type="text" class="form-control" id="id_materialB" name="id_materialB" readonly="readonly"
                                value="<?php echo $row['id_material']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="id_albaranB"><?php echo $literales['stockId_albaran']; ?></label>
                        <input type="text" class="form-control" id="id_albaranB" name="id_albaranB" readonly="readonly"
                               value="<?php echo $row['id_albaran']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="id_productoB"><?php echo $literales['stockId_producto']; ?></label>
                        <input type="text" class="form-control" id="id_productoB" name="id_productoB" readonly="readonly"
                               value="<?php $prod=$row['id_producto'];
                                            if ($prod==null){
                                                $prod='(No asignado)';
                                            }
                                            echo $prod;
                                      ?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminarStock']?>"type="submit">
                        <a class="btn btn-default" href="STOCK_MATERIAL_Controller.php?id=SHOWALLSTOCK_MATERIAL&ctr=STOCK_MATERIAL"> <?php echo $literales['cancelarStock'];?></a>
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