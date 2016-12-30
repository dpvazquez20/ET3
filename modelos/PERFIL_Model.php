<?php

require('PERFIL.php');
require_once ('../conectarBD.php');
class Perfil_modelo{

    var $mysql2;
    var $perfil;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->perfil= new Perfil();

    }

    function altaPerfil($perfilAInsertar){
        $this->mysql = conectarBD();
        $sql = " SELECT * FROM perfil where nombre='".$perfilAInsertar->getNombre()."'; ";
        $resultado= $this->mysql->query($sql);
        if($resultado->num_rows==0){
            $sqlInsert= "INSERT INTO perfil (nombre) VALUES ('".$perfilAInsertar->getNombre()."')";
            $this->mysql->query($sqlInsert);
            return "Se creo el perfil correctamente";
        }else{
            return "el perfil ya existe, lo sentimos";
        }
    }
    function deletePerfil($nombre){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM perfil WHERE nombre='".$nombre."';";
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente el perfil";
        }else{
            return"Lo sentimos, no se ha podido eliminar el perfil";
        }

    }
    function modifyPerfil($nombreAModificar,$perfilAModificar){
        $this->mysql= conectarBD();
        $sql = "UPDATE perfil SET nombre='" . $perfilAModificar->getNombre() ."' WHERE nombre='".$nombreAModificar."';";
        if($this->mysql->query($sql)){
            return "El perfil ha sido modificado correctamente";
        }else{
            return "El perfil ya existe";
        }
    }


    public static function listarPerfiles()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM perfil";
        $resul = $conexion->query($sql);
        return $resul;
    }

  /*  function getPermisoPerfil($perfil){
        $conexion = conectarBD();
        if($perfil==""){
            $sql = "SELECT * FROM permisos";
        }else {
            $sql = "SELECT * FROM permisos WHERE perfil='" . $perfil . "'";

        }
        $resul = $conexion->query($sql);
        return $resul;
    }
  */
   public static function getPerfil($nombre){
        $conexion= conectarBD();
        $sql= "SELECT * from perfil WHERE nombre='".$nombre."';";
        return $conexion->query($sql);
    }
}



?>