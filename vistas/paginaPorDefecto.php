<html>
<head>
    <?php include_once('cabecera.php');
    ?>
</head>
    <body>
        <div class="row-fluid">
            <?php include_once('menu.php'); ?>
            <div class="col-sm-9">
                <?php
                echo "Tu perfil es:".$_SESSION['perfil'];?>

            </div>
            <?php require_once ('pieDePagina.php') ?>



        </div>
    </body>
</html>

