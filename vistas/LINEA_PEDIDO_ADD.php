<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/MATERIAL_Model.php');

class Linea_Pedido_add{

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

                <title><?php echo $literales['nuevo linea de pedido']; ?></title>

                <div class="alert alert-info"><?php echo $literales['pedidoADD']?></div>

                <form role="form" action="PEDIDO_Controller.php?id=ADDLINEAPEDIDO&ctr=PEDIDO&idPedido=<?php echo $_GET['idPedido'];?>" method="POST">
                    <div  style="align-items: center" class="form-group">
                        <label for="id_pedido">ID Pedido</label>
                        <input  type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                                value="<?php echo $_GET['idPedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_material">Material</label>
                        <select name="nombre_material" class="form-control">
                            <option value="" selected></option>
                            <?php $resul = Material_modelo::listarMateriales();?>
                            <?php while($rowM = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowM["id"] ?>"><?= "Nombre: " . $rowM["nombre"]." Descripción: ". $rowM["descripcion"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" id="cantidad">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado">
                            <option value="completa">completa</option>
                            <option value="pendiente">pendiente</option>
                            <option value="por llegar">por llegar</option>
                        </select>
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="precio">Precio</label>
                        <input  type="text" class="form-control" id="precio" name="precio"
                                placeholder="Precio">
                    </div>
                    <div class="form-group">
                        <label for="iva">IVA</label>
                        <input type="text" name="iva" class="form-control" placeholder="IVA" id="iva">
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary"value="Enviar" type="submit">
                            <input class="btn btn-default" value="<?php echo $literales['reset']; ?>" type="reset"></div>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}

?>