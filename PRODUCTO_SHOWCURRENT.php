<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/PRODUCTO_Model.php');

class Producto_show{

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
                <div class="alert alert-success"><?php echo $literales['productoSHOW']?></div>

                <form role="form" action="CONTROLADOR_Controller.php?id=SHOWCONTROLADOR&ctr=CONTROLADOR" method="POST">
                    <div class="form-group">
                        <label for="nombreB">Nombre</label>
                        <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                                value="<?php  echo $row['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="descripcionB">Descripcion</label>
                        <input  type="text" class="form-control" id="descripcionB" name="descripcionB" readonly="readonly"
                                value="<?php  echo $row['descripcion']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <a class="btn btn-default" href="PRODUCTO_Controller.php?id=SHOWALLPRODUCTO&ctr=PRODUCTO";"><?php echo $literales['volver'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>