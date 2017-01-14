<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
include_once ('../modelos/PRODUCTO_Model.php');
class Producto_delete{

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
                <div class="alert alert-danger"><?php echo $literales['productoDELETE']?></div>

                <form role="form" action="PRODUCTO_Controller.php?id=DELETEPRODUCTO&ctr=PRODUCTO" method="POST">
                    <div class="form-group">
                        <input type="hidden" id="productoAModificar" name="productoAModificar" value="<?php echo $row['id_producto']?>">
                        <label for="nombreB"><?php$literales['nombre'] ?></label>
                        <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                                value="<?php  echo($row['nombre'])?>">
                    </div>
                    <div class="form-group">
                        <label for="descripcionB"><?php$literales['descripcion'] ?></label>
                        <input  type="text" class="form-control" id="descripcionB" name="descripcionB" readonly="readonly"
                                value="<?php  echo ($row['descripcion'])?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
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