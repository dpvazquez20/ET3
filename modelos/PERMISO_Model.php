<?php

require ('PERMISO.php');
require_once ('../conectarBD.php');
class Permiso_modelo{

    var $mysql2;
    var $permiso;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->permiso= new Permiso();

    }

    function altAPermiso($permiso){
        $this->mysql = conectarBD();
        $sql= "SELECT * FROM permisos WHERE controlador='".$permiso->getControlador()."'AND accion='".$permiso->getAccion()."' AND perfil='".$permiso->getPerfil()."'";
        $resultado= $this->mysql->query($sql);
        if($resultado->num_rows==0){
            $insertar= "INSERT INTO permisos (controlador,accion,perfil) VALUES('".$permiso->getControlador()."','".$permiso->getAccion()."','".$permiso->getPerfil()."');";
            $this->mysql->query($insertar);
            return "El permiso ha sido añadido";
        
    }else{
        return "Lo sentimos ese permiso ya existe";
        }
    }

    function deletePermiso($id){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM permisos WHERE id_permiso='".$id."';";
       if($this->mysql->query($sql)){
           return "Se ha eliminado con exito el permiso";
       }else{
           return "lo sentimos no se ha podido eliminar el permiso";
       }

    }

    function modifyPermiso($permioAModificar,$permisoID)
    {
        $this->mysql = conectarBD();
        $sqlPermisos = "SELECT * FROM permisos WHERE controlador='" . $permioAModificar->getControlador() . "'AND accion='" . $permioAModificar->getAccion() . "'AND perfil='" . $permioAModificar->getPerfil() . "'";
        $resul = $this->mysql->query($sqlPermisos);
        if ($resul->num_rows==0) {
            $sql = "UPDATE permisos SET controlador='" . $permioAModificar->getControlador() . "',accion='" . $permioAModificar->getAccion() . "',perfil='" . $permioAModificar->getPerfil() . "' WHERE id_permiso='" . $permisoID . "';";
            echo $sql;
            if ($this->mysql->query($sql)) {
                return "El permiso de ha modificado con exito";
            } else {
                return "El permiso no se ha podido modificar";
            }
        }else{
            return "Ese permiso ya existe";
        }
    }

    public static function mostrarPagina($controlador,$accion,$perfilUsuario){
        $conexion= conectarBD();
        $sql ="SELECT * from permisos WHERE controlador='".$controlador."'AND accion='".$accion."'AND perfil='".$perfilUsuario."'";
        $resul = $conexion->query($sql);
        if($resul->num_rows>0){
            return true;
        }else{
            return false;
        }
    }

    public static function getPermiso($id){
        $conexion= conectarBD();
        $sql= "SELECT * from permisos WHERE id_permiso='".$id."';";
        return $conexion->query($sql);
    }
    public static function listarPermisos()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM permisos";
        $resul = $conexion->query($sql);
        return $resul;
    }
}





?>