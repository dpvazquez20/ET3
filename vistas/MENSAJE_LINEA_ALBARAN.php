<?php
//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
session_start();
}


class Mensaje_linea_albaran
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
                <div class="alert alert-success"><h1><?php echo $_SESSION['mensaje']?></h1> </div>
                <?php echo "<a href='../controladores/".$_GET['ctr']."_Controller.php?id=SHOW".$_GET['ctr']."&ctr=".$_GET['ctr']."&idAlbaran=".$_SESSION['id_albaran']."'><button  class='btn  btn-default'>".$literales['volver']."</butto></a>";
                ?>

            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>