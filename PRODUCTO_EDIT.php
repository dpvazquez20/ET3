<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PRODUCTO_Model.php');

class Producto_edit{

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
                <?php

                $resul= Producto_modelo::getProducto($_GET['idProducto']);
                $row = mysqli_fetch_assoc($resul);

                ?>
                <div class="alert alert-warning"><?php echo $literales['productoMODIFY']?></div>

                <form role="form" action="PRODUCTO_Controller.php?id=EDITPRODUCTO&ctr=PRODUCTO" method="POST">
                    <input type="hidden" id="productoAModificar" name="productoAModificar" value="<?php echo $row['id_producto']?>">
                    <div class="form-group">
                        <label for="nombreM"><?php$literales['nombre'] ?></label>
                        <input  type="text" class="form-control" id="nombreM" name="nombreM"
                                value="<?php  echo $row['nombre']?>">
                    </div>

                    <div class="form-group">
                        <label for="descripcionM"><?php$literales['descripcion'] ?></label>
                        <input  type="text" class="form-control" id="descripcionM" name="descripcionM"
                                value="<?php  echo $row['descripcion']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>"type="submit">
                        <a class="btn btn-default" href="PRODUCTO_Controller.php?id=SHOWALLPRODUCTO&ctr=PRODUCTO";">&laquo; <?php echo $literales['cancelar'];?></a>
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