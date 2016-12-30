<?php

require('ACCION.php');
require_once ('../conectarBD.php');
class Accion_modelo{

    var $mysql2;
    var $accion;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->accion= new Accion();

    }

    function altaAccion($accionAInsertar){
        $this->mysql = conectarBD();
        $sql = " SELECT * FROM accion where nombre='".$accionAInsertar->getNombre()."'; ";
        $resultado= $this->mysql->query($sql);
        if($resultado->num_rows==0){
            $sqlInsert= "INSERT INTO accion (nombre) VALUES ('".$accionAInsertar->getNombre()."')";
            $this->mysql->query($sqlInsert);
            return "Se creo la acción correctamente";
        }else{
            return "La acción ya existe, lo sentimos";
        }
    }
    function deleteAccion($nombre){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM accion WHERE nombre='".$nombre."';";
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente la acción";

        }else{
            return"Lo sentimos, no se ha podido eliminar la acción";

        }

    }
    function modifyAccion($nombreAModificar,$accionModificar){
        $this->mysql= conectarBD();
        $sql = "UPDATE accion SET nombre='" . $accionModificar->getNombre() ."' WHERE nombre='".$nombreAModificar."';";
        if($this->mysql->query($sql)){
            return "la acción ha sido modificado correctamente";

        }else{
            return "la acción ya existe";

        }
    }

    public static function listarAcciones()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM accion";
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getAccion($nombre){
        $conexion= conectarBD();
        $sql= "SELECT * from accion WHERE nombre='".$nombre."';";
        return $conexion->query($sql);
    }
}



?>