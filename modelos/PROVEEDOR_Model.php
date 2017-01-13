<?php

require('PROVEEDOR.php');
require_once ('../conectarBD.php');
class Proveedor_modelo
{

    var $mysql2;
    var $proveedor;

    //constructor de la clase Proveedor modelo

    function __construct()
    {
        $this->mysql2 = conectarBD();
        $this->proveedor = new Proveedor();

    }

    //da de alta un proveedor

    function altaProveedor($proveedor)
    {
        $this->mysql = conectarBD();
        $sql = "SELECT * FROM proveedor WHERE nif='" . $proveedor->getNif() . "';";
        $resultado = $this->mysql->query($sql);
        if ($resultado->num_rows == 0) {
            $insertar = "INSERT INTO proveedor (nombre,nif,correo_electronico,telefono,direccion,codigo_postal,ciudad,provincia) VALUES('" . $proveedor->getNombre() . "','" . $proveedor->getNif() . "','"  . $proveedor->getCorreoE() . "','" . $proveedor->getTelefono() . "','" .$proveedor->getDireccion() . "','" . $proveedor->getCodigoP() . "','" . $proveedor->getCiudad() . "','" . $proveedor->getProvincia() ."');";
            $this->mysql->query($insertar);

            return "El proveedor se ha creado correctamente";
        } else {
            return "El proveedor ya existe";
        }
    }

    //borra un proveedor

    function deleteProveedor($id)
    {

        $this->mysql = conectarBD();
        $sql = "DELETE FROM proveedor WHERE id='" . $id . "';";
        if ($this->mysql->query($sql)) {
            return "Se ha eliminado correctamente el proveedor";

        } else {
            return "Lo sentimos, no se ha podido eliminar el proveedor";

        }


    }

    //modifica a un proveedor de la base de datos

    function modifyProveedor($id_proveedor, $proveedorModificado)
    {
        $this->mysql = conectarBD();
        $sql = "UPDATE proveedor SET nombre='" . $proveedorModificado->getNombre() . "',nif='" . $proveedorModificado->getNif() . "',correo_electronico='" . $proveedorModificado->getCorreoE() . "',telefono='" . $proveedorModificado->getTelefono() . "',direccion='" . $proveedorModificado->getDireccion() . "',codigo_postal='" . $proveedorModificado->getCodigoP() . "',ciudad='" . $proveedorModificado->getCiudad() . "',provincia='" . $proveedorModificado->getProvincia() .
            "' WHERE id='" . $id_proveedor . "';";
        if ($this->mysql->query($sql)) {
            return "el proveedor ha sido modificado correctamente";

        } else {
            return "Lo sentimos, no se ha modificado el proveedor";

        }
    }

    //devuelve un proveedor de la base de datos


    public static function getProveedor($idProveedor)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM proveedor WHERE id ='" . $idProveedor . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve todos los proveedores de la base de datos

    public static function listarProveedores()
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM proveedor";
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve un proveedor según su nombre

    public static function getNombreProveedor($nombre){
        $conexion = conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM proveedor";
        } else {
            $sql = "SELECT * FROM proveedor WHERE nombre LIKE '".$nombre."%';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve un proveedor según su nif

    public static function getNIFProveedor($nif){
        $conexion = conectarBD();
        if ($nif == "") {
            $sql = "SELECT * FROM proveedor";
        } else {
            $sql = "SELECT * FROM proveedor WHERE nif LIKE '".$nif."%';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

}

?>