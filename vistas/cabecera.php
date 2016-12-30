<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
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
}else{
    include("../idioma/castellano.php");
}
?>
<body>

<nav  class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../vistas/paginaPorDefecto.php">NUEVO LOGO SE PONDRA LUEGO</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a><span class="glyphicon glyphicon-user"></span> WELCOME BACK <?php echo $_SESSION['usuario']?></a></li>
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


