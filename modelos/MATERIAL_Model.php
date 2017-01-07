<?php

require('MATERIAL.php');
require_once ('../conectarBD.php');
class Material_modelo{

    var $mysql2;
    var $material;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->material= new Material();

    }

    function altaMaterial($materialAInsertar){

        $this->mysql = conectarBD();
        $insertar = "INSERT INTO material (nombre,descripcion) VALUES('".utf8_encode($materialAInsertar->getNombre())."','".utf8_encode($materialAInsertar->getDescripcion())."');";
        if($this->mysql->query($insertar)){
            return "Se creo el material correctamente";
        }else{
            return "No se ha podido insertar el material";
        } 

    }
    function deleteMaterial($idBorrar){

        $this->mysql = conectarBD();
        $sql = "UPDATE material SET borrado='1' WHERE id='".$idBorrar."';";
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente el material";

        }else{
            return"Lo sentimos, no se ha podido eliminar el material";

        }

    }
    function modifyMaterial($nombreAModificar,$descripcionAModificar,$materialModificar){
        $this->mysql= conectarBD();
        $sql = "UPDATE material SET nombre='" . utf8_encode($nombreAModificar) ."',descripcion='". utf8_encode($descripcionAModificar) ."' WHERE id='".$materialModificar."';";
        if($this->mysql->query($sql)){
            return "El material ha sido modificado correctamente";

        }else{
            return "El material no ha podido modificarse";

        }
    }

    public static function listarMateriales()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM material WHERE borrado='0'";
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getMaterial($id){
        $conexion= conectarBD();
        $sql= "SELECT * from material WHERE id='".$id."';";
        return $conexion->query($sql);
    }
    
    public static function getMaterialNombre($nombre){
        $conexion = conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM material WHERE borrado='0'";
        } else {
            $sql = "SELECT * FROM material WHERE nombre LIKE '%".$nombre."%' AND borrado='0';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }
    
    public static function getMaterialId($id){
        $conexion = conectarBD();
        if ($id == "") {
            $sql = "SELECT * FROM material WHERE borrado='0'";
        } else {
            $sql = "SELECT * FROM material WHERE id='".$id."' AND borrado='0';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }
    
}



?>