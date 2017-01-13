<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="bootstrap/login.css">
</head>


<body>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
                <h4>Crear Base de datos.</h4>
                <form role="form" action="install.php" method="post" class="login-form">
                    <input type="text"  name="usuario" id="usuario" class="form-control input-sm chat-input" placeholder="username" />
                    </br>
                    <input type="password"  name="password"id="password" class="form-control input-sm chat-input" placeholder="password" />
                    </br>
                    <div class="wrapper">
                            <span class="group-btn">
                                <button type="submit" class="btn btn-primary btn-md">Login <i class="fa fa-sign-in"></i></button>
                            </span>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<!-- Javascript -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>
<?php

//Crea la BD.
if(isset($_POST['usuario'])){

    $user=$_POST['usuario'];
    $password=$_POST['password'];

    $command = "mysql -u ".$_POST['usuario']." -p".$_POST['password']." < BD/sql.sql";
    $last_line = exec($command, $output, $return_var);

    if ($return_var === 0) {
        echo "<div class='col-sm-4 text-left'></div>
            <div class='col-sm-4 text-left'>
                <div class='alert alert-success'>ÉXITO al crear la base de datos.</div>
                <div><a href='login.php' class='btn btn-primary'>Acceder a la aplicación</a></div>
            </div>";


    }else{
        echo "<div class='col-sm-4 text-left'></div><div class='col-sm-4 text-left'><div class='alert alert-danger'>¡ERROR! El usuario no existe.</div></div>";
    }

}
?>