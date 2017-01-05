<?php

//Crea una conexión con la base de datos.
function conectarBD(){

    $bd = new mysqli("localhost", "root", "iu", "ET3Grupo5");
    if (mysqli_connect_errno()){
        echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
    }
    return $bd;
}
?>