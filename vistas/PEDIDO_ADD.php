<?php


require_once ('../modelos/PROVEEDOR_Model.php');
require_once ('../modelos/USUARIO_Model.php');
require_once ('../modelos/PEDIDO_Model.php');

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

class Pedido_add{

    function __construct(){
        $this->render();
    }

    //Formulario para rellenar los datos y crear un pedido. Los datos a
    //rellenar son el proveedor, el usuario, y la fecha.

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

                <title><?php echo $literales['nuevo pedido']; ?></title>

                <div class="alert alert-info"><?php echo $literales['pedidoADD']?></div>

                <form role="form" action="PEDIDO_Controller.php?id=ADDPEDIDO&ctr=PEDIDO" method="POST">

                    <div class="form-group">
                        <label for="proveedor"><?php echo $literales['proveedor']?></label>
                        <select name="proveedor" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Proveedor_modelo::listarProveedores();?>
                            <?php while($rowP = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowP["id"] ?>"><?= $rowP["nombre"]." NIF: ". $rowP["nif"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="usuario"><?php echo $literales['usuario']?></label>
                        <select name="usuario" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Usuario_modelo::listar();?>
                            <?php while($rowU = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowU["id_usuario"] ?>"><?= $rowU["nombre"]. " " .$rowU["apellido"] . " DNI: ". $rowU["DNI"] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha"><?php echo $literales['fecha']?></label>
                        <input type="text" name="fecha" class="form-control" id="fecha" required>
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