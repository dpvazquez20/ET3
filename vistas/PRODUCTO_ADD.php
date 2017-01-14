<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}


class Producto_add
{

    function __construct()
    {
        $this->render();
    }

    function render()
    {
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include('menu.php'); ?>
            <!-- Título de la página -->
            <div class="col-sm-9">
                <div class="alert alert-info"><?php echo $literales['productoADD'] ?> </div>

                <form role="form" action="PRODUCTO_Controller.php?id=ADDPRODUCTO&ctr=PRODUCTO" method="POST">
                    <div class="form-group">
                        <label for="Nombre"><?php$literales['nombre'] ?></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required
                               placeholder="Introduce el nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="Descripcion"><?php$literales['nombre'] ?></label>
                        <input type="text" class="form-control" id="descripcio" name="descripcion" required
                               placeholder="Introduce la descripcion del producto">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary" value="Enviar" type="submit">
                            <a class="btn btn-default" href="PRODUCTO_Controller.php?id=SHOWALLPRODUCTO&ctr=PRODUCTO"><?php echo $literales['cancelar']; ?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>