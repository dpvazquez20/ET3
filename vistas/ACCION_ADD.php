<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}


class Accion_add
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
                <div class="alert alert-info"><?php echo $literales['accionADD'] ?> </div>

                <form role="form" action="ACCION_Controller.php?id=ADDACCION&ctr=ACCION" method="POST">
                    <div class="form-group">
                        <label for="Nombre"><?php$literales['nombre'] ?></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-_]{2,48}"
                               placeholder="Introduce nombre de la acción">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary" value="Enviar" type="submit">
                            <a class="btn btn-default" href="ACCION_Controller.php?id=SHOWALLACCION&ctr=ACCION"><?php echo $literales['cancelar']; ?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>