<?php

require('ELABORACION.php');
require_once ('../conectarBD.php');
class Elaboracion_modelo{

    var $mysql2;
    var $elaboracion;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->elaboracion= new elaboracion();

    }

    function altaElaboracion($productoAInsertar){
        $this->mysql = conectarBD();
        $sql="SELECT * FROM elaboracion WHERE nombre_elaboracion='".$productoAInsertar->getNombre()."';";
        echo $sql;
        $resul = $this->mysql->query($sql);
        if($resul->num_rows>0){
            return "Lo sentimos, esa elaboracion ya existe";

        }else{
            $sql="INSERT INTO elaboracion (nombre_elaboracion) VALUES ('".$productoAInsertar->getNombre()."')";
            $this->mysql->query($sql);
            return "Se creo correctamente la elaboracion";
        }
    }
    function deleteElaboracion($id){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM elaboracion WHERE id_elaboracion='".$id."';";
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente la elaboracion del producto";

        }else{
            return"Lo sentimos, no se ha podido eliminar la elaboracion";

        }

    }
    function modifyElaboracion($nombreAModificar,$Id_Modificar){
        $this->mysql= conectarBD();
        $sql1= "SELECT * from elaboracion WHERE nombre_elaboracion='".$nombreAModificar."'";
        if($this->mysql->query($sql1)->num_rows=='0') {
            $sql = "UPDATE elaboracion SET nombre_elaboracion='" . $nombreAModificar . "' WHERE id_elaboracion='" . $Id_Modificar . "';";
            if ($this->mysql->query($sql)) {
                return "La elaboracion ha sido modificada correctamente";

            } else {
                return "la elaboracion no ha podido ser modificada";

            }
        }else{
            return "Lo sentimos, ya existe la elaboración";
        }
    }

    public static function listarElaboracion()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM elaboracion";
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getElaboracion($nombre){
        $conexion= conectarBD();
        $sql= "SELECT * from elaboracion WHERE nombre_elaboracion='".$nombre."';";
        return $conexion->query($sql);
    }
    public static function getElaboracionID($id){
        $conexion= conectarBD();
        $sql= "SELECT * from elaboracion WHERE id_elaboracion='".$id."';";
        return $conexion->query($sql);
    }


    public static function getNombreElaboracion($id){
        $conexion= conectarBD();
        $sql= "SELECT * from elaboracion WHERE nombre_elaboracion LIKE '".$id."%';";
        return $conexion->query($sql);
    }






}



?>