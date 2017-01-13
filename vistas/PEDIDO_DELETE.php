<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PEDIDO_Model.php');
include_once ('../modelos/PROVEEDOR_Model.php');
include_once ('../modelos/USUARIO_Model.php');

class Pedido_delete{

    function __construct(){
        $this->render();
    }

    //Vista para borrar un pedido. Los datos a
    //que aparecen son el nombre del proveedor, el NIF,
    //el usuario, y la fecha

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['eliminar pedido']; ?></title>
                <?php $resul = Pedido_modelo::getPedido($_GET['idPedido']);
                $row= mysqli_fetch_assoc($resul);

                $resulP = Proveedor_modelo::getProveedor($row['id_proveedor']);
                $rowP = mysqli_fetch_assoc($resulP);
                $resulU = Usuario_modelo::getUsuarioSinBorrar($row['id_usuario']);
                $rowU = mysqli_fetch_assoc($resulU);
                ?>

                <div class="alert alert-danger"><?php echo $literales['pedidoDELETE']?></div>
                <form role="form" action="PEDIDO_Controller.php?id=DELETEPEDIDO&ctr=PEDIDO" method="POST">
                    <div class="form-group">
                        <label for="NIFE"><?php echo $literales['proveedor']?></label>
                        <input type="text" class="form-control" id="NIFE" name="NIFE" readonly="readonly"
                               value="<?php echo $rowP['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="NIFE">NIF</label>
                        <input type="text" class="form-control" id="NIFE" name="NIFE" readonly="readonly"
                               value="<?php echo $rowP['nif']?>">
                    </div>

                    <div  style="align-items: center" class="form-group">
                        <label for="DNIE"><?php echo $literales['usuario']?></label>
                        <input type="text" class="form-control" id="DNIE" name="DNIE" readonly="readonly"
                               value="<?php echo $rowU['DNI']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="fecha"><?php echo $literales['date']?></label>
                        <input type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                               value="<?php echo $row['fecha']?>">
                    </div>

                    <input type="hidden" class="form-control" id="IDE" name="IDE"
                           value="<?php echo $row['id']?>">

                    <input type="hidden" class="form-control" id="IDPedidoE" name="IDPedidoE"
                           value="<?php echo $row['id_usuario']?>">

                    <div class="form-group">
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="PEDIDO_Controller.php?id=SHOWALLPEDIDO&ctr=PEDIDO";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>
                    </form>
            </div>
        </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>