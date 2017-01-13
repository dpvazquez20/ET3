<?php

if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/PEDIDO_Model.php');
include_once ('../modelos/PROVEEDOR_Model.php');
include_once ('../modelos/USUARIO_Model.php');

class Pedido_edit{

    function __construct(){
        $this->render();
    }

    //Formulario para modificar un pedido. Los datos a
    //que aparecen son el nombre del proveedor, el NIF,
    //el usuario, y la fecha

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">
                <!-- para el calendario -->
                <script>
                    $( function() {
                        $( "#fecha" ).datepicker();
                    } );
                </script>

                <?php $resul = Pedido_modelo::getPedido($_GET['idPedido']);
                $row1= mysqli_fetch_assoc($resul);

                ?>
                <div class="alert alert-warning"><?php echo $literales['pedidoEDIT']?></div>
                <form role="form" action="PEDIDO_Controller.php?id=EDITPEDIDO&ctr=PEDIDO" method="POST">

                    <input type="hidden" class="form-control" id="id_pedido" name="id_pedido"
                           value="<?php echo $row1['id']?>">

                    <div class="form-group">
                        <label for="proveedorM"><?php echo $literales['proveedor'] ?></label>
                        <select name="proveedorM" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Proveedor_modelo::listarProveedores();?>
                            <?php while($rowP = mysqli_fetch_assoc($resul)){?>
                                <?php if($rowP['id'] == $row1['id_proveedor']){?>
                                    <option value="<?php echo $rowP["id"] ?>" selected><?=  $rowP["nombre"]." NIF: ". $rowP["nif"] ?></option>
                            <?php } else{ ?>
                                    <option value="<?php echo $rowP["id"] ?>"><?=  $rowP["nombre"]." NIF: ". $rowP["nif"] ?></option>
                                <?php }}?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="usuarioM"><?php echo $literales['usuario'] ?></label>
                        <select name="usuarioM" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Usuario_modelo::listar();?>
                            <?php while($rowU = mysqli_fetch_assoc($resul)){?>
                                <?php if($rowU['id_usuario'] == $row1['id_usuario']){?>
                                    <option value="<?php echo $rowU["id_usuario"] ?>" selected><?= $rowU["nombre"]. " " .$rowU["apellido"] . " DNI: ". $rowU["DNI"] ?></option>
                                <?php }else{?>
                                    <option value="<?php echo $rowU["id_usuario"] ?>"><?= $rowU["nombre"]. " " .$rowU["apellido"] . " DNI: ". $rowU["DNI"]  ?></option>
                                <?php }}?>
                        </select>
                    </div>


                    <div  style="align-items: center" class="form-group">
                        <label for="fecha"><?php echo $literales['fecha'] ?></label>
                        <input type="text" class="form-control" name="fecha" id="fecha" required
                               value="<?php echo $row1['fecha']?>">
                    </div>

                    <div class="form-group">
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                        <a class="btn btn-default" href="../controladores/PEDIDO_Controller.php?id=SHOWALLPEDIDO&ctr=PEDIDO";">&laquo; Volver atrás</a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>