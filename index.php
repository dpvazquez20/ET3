<html>
<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("location: login.php");
}else{
    header("location: vistas/paginaPorDefecto.php");
}

?>
</html>
