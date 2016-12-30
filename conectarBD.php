<?php

//Crea una conexión con la base de datos.
function conectarBD(){

    $bd = new mysqli("localhost", "root", "iu", "nuevaBD");
    if (mysqli_connect_errno()){
        echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
    }
    return $bd;
}
?>