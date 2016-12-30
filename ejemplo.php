<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
</head>
<?php
//Carga el idioma guardado en la variable de sesión o el Español por defecto
if(isset($_SESSION['lang'])){
    if(strcmp($_SESSION['lang'],'gal')==0)
        include("../idioma/gallego.php");
    else if(strcmp($_SESSION['lang'],'esp')==0)
        include("../idioma/castellano.php");
}else{
    include("../idioma/castellano.php");
}
?>
<body>
<div class="row navbar-inverse">
        <div class=".col-md-12">
            <nav>
                <div>
                    <div class="navbar navbar-inverse sidebar" role="navigation">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownmenu1" data-toggle="dropdown" aria-expanded="true">
                                <?php echo $literales['idioma']; ?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownmenu1">
                                <li role="presentation"> <a href="../modelos/cambiarIdioma.php?lang=esp">Castellano</a></li>
                                <li role="presentation"> <a href="../modelos/cambiarIdioma.php?lang=gal">Gallego</a></li>
                            </ul>
                        </div>
                    </div>
                        <ul class="nav navbar-nav">
                            <li><a class="active" href="../vistas/paginaPorDefecto.php">
                                    <span style="font-size:20px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a>
                </div>
            </nav>
    </div>
</div>


