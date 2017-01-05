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

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['nuevo pedido']; ?></title>

                <div class="alert alert-info"><?php echo $literales['pedidoADD']?></div>

                <form role="form" action="PEDIDO_Controller.php?id=ADDPEDIDO&ctr=PEDIDO" method="POST">

                    <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <select name="proveedor" class="form-control">
                            <option value="" selected></option>
                            <?php $resul = Proveedor_modelo::listarProveedores();?>
                            <?php while($rowP = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowP["id"] ?>"><?= "Nombre: " . $rowP["nombre"]." NIF: ". $rowP["nif"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <select name="usuario" class="form-control">
                            <option value="" selected></option>
                            <?php $resul = Usuario_modelo::listar();?>
                            <?php while($rowU = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowU["id_usuario"] ?>"><?= "Nombre: " . $rowU["nombre"]. " " .$rowU["apellido"] . " DNI: ". $rowU["DNI"] ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="usuario">Usuario2</label>
                        <input name="usuario" class="form-control" value="<?php echo $_SESSION['dni']?>">
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" class="form-control" placeholder="ej: 2015-12-15" id="fecha">
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