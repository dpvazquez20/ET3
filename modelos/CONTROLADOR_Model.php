<?php

require('CONTROLADOR.php');
require_once ('../conectarBD.php');
class Controlador_modelo{

    var $mysql2;
    var $controlador;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->controlador= new Controlador();

    }



    function altaControlador($controladorInsertar){
        $this->mysql = conectarBD();
        $sql = " SELECT * FROM controlador where nombre='".$controladorInsertar->getNombre()."'; ";
        $resultado= $this->mysql->query($sql);
        if($resultado->num_rows==0){
            $sqlInsert= "INSERT INTO controlador (nombre) VALUES ('".$controladorInsertar->getNombre()."')";
            $this->mysql->query($sqlInsert);
            return "Se creo el controlador correctamente";
        }else{
            return "El controlador ya existe, lo sentimos";
        }
    }

    function deleteControlador($nombre){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM controlador WHERE nombre='".$nombre."';";
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente el controlador";

        }else{
            return"Lo sentimos, no se ha podido eliminar el controlador";
        }


    }
    function modifyControlador($nombreAModificar,$controladorModificar){
        $this->mysql= conectarBD();
        $sql = "UPDATE controlador SET nombre='" . $controladorModificar->getNombre() ."' WHERE nombre='".$nombreAModificar."';";
        if($this->mysql->query($sql)){
            return "El controlador ha sido modificado correctamente";

        }else{
            return "El controlador ya existe";

        }
    }

   public static function controladores($perfil){
        $conexion= conectarBD();
        $sql= "SELECT * FROM permisos where perfil='$perfil'";
        $resul= $conexion->query($sql);
        return $resul;

    }

    public static function listarControladores()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM controlador";
        $resul = $conexion->query($sql);
        return $resul;
    }
    public static function getControlador($nombre){
        $conexion= conectarBD();
        $sql= "SELECT * from controlador WHERE nombre='".$nombre."';";
        return $conexion->query($sql);
    }
}





?>