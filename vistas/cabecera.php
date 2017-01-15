<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="../bootstrap/css/menu.css" type="text/css" media="all" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['usuario'])){
//Carga el idioma guardado en la variable de sesión o el Español por defecto
if(isset($_SESSION['lang'])){
    if(strcmp($_SESSION['lang'],'gal')==0)
        include("../idioma/gallego.php");
    else if(strcmp($_SESSION['lang'],'esp')==0)
        include("../idioma/castellano.php");
    else if(strcmp($_SESSION['lang'],'ing')==0)
        include("../idioma/ingles.php");
}else{
    include("../idioma/castellano.php");
}
?>
<body>

<nav  class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../vistas/paginaPorDefecto.php"><span class="glyphicon glyphicon-home"></span></a>
        </div>
        <ul class="nav navbar-nav">
            <li><a><span class="glyphicon glyphicon-user"></span> WELCOME BACK <?php echo $_SESSION['usuario']?></a></li>

            <li><a href="../modelos/cambiarIdioma.php?lang=esp">Español</a></li>
            <li><a href="../modelos/cambiarIdioma.php?lang=gal">Gallego</a></li>
            <li><a href="../modelos/cambiarIdioma.php?lang=ing">Ingles</a></li>



            <li><a href="../vistas/logout.php"><span class="glyphicon glyphicon-off"></span></a></li>
        </ul>
    </div>

</nav>


<!-- <ul class="navbar">

        <li>
            <p>Nos alegramos de ver de nuevo <?php echo $_SESSION['usuario']?></p>
            <a href="../vistas/logout.php"><span class="glyphicon glyphicon-cog"></span>
            </a>
        </li>
        <li><a href="../vistas/logout.php"><span class="glyphicon glyphicon-cog"></span>
                </a>
        </li>
        <li>><a href="../vistas/paginaPorDefecto.php"><span class="glyphicon glyphicon-home"></span>
            </a></li>
    </ul>
    -->
<?php }else{
    header("location: ../login.php");
    }?>


