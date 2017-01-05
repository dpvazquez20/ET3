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
                        <label for="id_pedido">ID Pedido</label>
                        <input type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                               value="<?php echo $row['id_pedido']?>">
                    </div>

                    <div class="form-group">
                        <label for="material">Material</label>
                        <select name="material" class="form-control">
                            <option value="" selected></option>
                            <?php $resul = Material_modelo::listarMateriales();?>
                            <?php while($rowM = mysqli_fetch_assoc($resul)){?>
                                <?php if($rowM['id'] == $row['id_material']){?>
                                    <option value="<?php echo $rowM["id"] ?>" selected><?= "Nombre: " . $rowM["nombre"]." Descripción: ". $rowM["descripcion"] ?></option>
                                <?php } else{ ?>
                                    <option value="<?php echo $rowM["id"] ?>"><?= "Nombre: " . $rowM["nombre"]." Descripción: ". $rowM["descripcion"] ?></option>
                                <?php }}?>
                        </select>
                    </div>

                    <div  style="align-items: center" class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" class="form-control" name="cantidad" id="cantidad"
                               value="<?php echo $row['cantidad']?>">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" value="<?php echo $row['estado']?>">
                            <option value="completa">completa</option>
                            <option value="pendiente">pendiente</option>
                            <option value="por llegar">por llegar</option>
                        </select>
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="precio">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio"
                               value="<?php echo $row['precio']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="iva">IVA</label>
                        <input type="text" class="form-control" name="iva" id="iva"
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