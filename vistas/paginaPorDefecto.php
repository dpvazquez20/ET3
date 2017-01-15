<html>
<head>
    <?php include_once('cabecera.php');
    ?>
</head>
    <body>
        <div class="row-fluid">
            <?php include_once('menu.php'); ?>
            <div class="col-sm-9">
                <h1>NOS ALEGRAMOS DE VERTE DE NUEVO  <?php echo $_SESSION['usuario']?></h1>
                <img align="right" src="../imagenes/portada.jpg" height="50%" width="80%" class=""/>

            </div>
            <?php require_once ('pieDePagina.php') ?>



        </div>
    </body>
</html>

