<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}


class Permiso_denegado
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
                <img align="right" src="../imagenes/accesoDenegado.jpg" height="50%" width="80%" class=""/>
                <script language="javascript">
                    setTimeout("location.href='../vistas/paginaPorDefecto.php'", 2000)
                </script>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>