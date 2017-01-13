<?php

if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/LINEA_PEDIDO_Model.php');
include_once ('../modelos/MATERIAL_Model.php');
class Linea_Pedido_edit{

    function __construct(){
        $this->render();
    }

    //Formulario para rellenar los datos y crear una linea de pedido. Los datos a
    //modificar son material, cantidad, estado, precio unitario sin iva, y la iva

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">
                <?php $resul = Linea_Pedido_modelo::getLineaPedido($_GET['idLineaPedido']);
                $row= mysqli_fetch_assoc($resul);

                ?>
                <div class="alert alert-warning"><?php echo $literales['lineaEDIT']?></div>
                <form role="form" action="PEDIDO_Controller.php?id=EDITLINEAPEDIDO&ctr=PEDIDO&idPedido=<?php echo $row['id_pedido'];?>" method="POST">

                    <input type="hidden" class="form-control" id="id_linea" name="id_linea"
                           value="<?php echo $row['id']?>">

                    <div  style="align-items: center" class="form-group">
                        <label for="id_pedido"><?php echo $literales['id pedido']?></label>
                        <input type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                               value="<?php echo $row['id_pedido']?>">
                    </div>

                    <div class="form-group">
                        <label for="material"><?php echo $literales['material']?></label>
                        <select name="material" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Material_modelo::listarMateriales();?>
                            <?php while($rowM = mysqli_fetch_assoc($resul)){?>
                                <?php if($rowM['id'] == $row['id_material']){?>
                                    <option value="<?php echo $rowM["id"] ?>" selected><?= $rowM["nombre"].  $literales['descripcion'] . $rowM["descripcion"] ?></option>
                                <?php } else{ ?>
                                    <option value="<?php echo $rowM["id"] ?>"><?= $rowM["nombre"].$literales['descripcion']. $rowM["descripcion"] ?></option>
                                <?php }}?>
                        </select>
                    </div>

                    <div  style="align-items: center" class="form-group">
                        <label for="cantidad"><?php echo $literales['cantidad']?></label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" min="0" required
                               value="<?php echo $row['cantidad']?>">
                    </div>
                    <div class="form-group">
                        <label for="estado"><?php echo $literales['estado']?></label>
                        <select name="estado" class="form-control" required>
                            <option value="<?php echo $row['estado']?>"selected><?php echo $literales[$row['estado']]?></option>
                            <option value="completa"><?php echo $literales['completa']?></option>
                            <option value="pendiente"><?php echo $literales['pendiente']?></option>
                            <option value="por llegar"><?php echo $literales['por llegar']?></option>
                        </select>
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="precio"><?php echo $literales['precio']?></label>
                        <input type="number" class="form-control" id="precio" name="precio" min="0" required
                               value="<?php echo $row['precio']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="iva">IVA</label>
                        <input type="text" class="form-control" name="iva" id="iva" min="0" max="50" required
                               value="<?php echo $row['IVA']?>">
                    </div>
                    <div class="form-group">
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                        <a class="btn btn-default" href="../controladores/PEDIDO_Controller.php?id=SHOWPEDIDO&ctr=PEDIDO&idPedido=<?php echo $row['id_pedido'];?>";">&laquo; Volver atrás</a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>