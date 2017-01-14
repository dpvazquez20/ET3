<?php

require('PRODUCTO.php');
require_once ('../conectarBD.php');
class Producto_modelo
{
    var $mysql2;
    var $producto;

    function __construct()
    {
        $this->mysql2 = conectarBD();
        $this->material = new Producto();

    }

    function altaProducto($productoAInsertar){

        $this->mysql = conectarBD();
        $insertar = "INSERT INTO producto (nombre,descripcion) VALUES('".utf8_encode($productoAInsertar->getNombre())."','".utf8_encode($productoAInsertar->getDescripcion())."');";
        if($this->mysql->query($insertar)){
            return "Se añadio el producto correctamente";
        }else{
            return "No se ha podido añadir";
        }

    }


    function deleteProducto($id_producto){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM producto WHERE id_producto='".$id_producto."';";
        echo $sql;
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente el producto";

        }else{
            return"Lo sentimos, no se ha podido eliminar el producto";
        }
    }

    function modifyProducto($nombreAModificar, $descripcionAModificar, $productoModificar){
        $this->mysql= conectarBD();
        $sql = "UPDATE producto SET nombre='" . $nombreAModificar ."', descripcion='" . $descripcionAModificar ."' WHERE id_producto='".$productoModificar."';";
        if($this->mysql->query($sql)){
            return "El producto ha sido modificado correctamente";

        }else{
            return "El producto no ha podido modificarse";

        }
    }


    public static function listarProducto(){
    $conexion = conectarBD();
    $sql = "SELECT * FROM producto";
    $result = $conexion->query($sql);
    return $result;

    }
    public static function getProducto($id){
        $conexion= conectarBD();
        $sql= "SELECT * from producto WHERE id_producto='".$id."';";
        return $conexion->query($sql);
    }

    public static function getNombreProducto($nombre){
        $conexion= conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM producto;";
        } else {
            $sql = "SELECT * from producto WHERE nombre LIKE '" . $nombre . "%';";
        }
        return $conexion->query($sql);
    }

    public static function getDEsProducto($id){
        $conexion= conectarBD();

        if ($id == "") {
            $sql = "SELECT * FROM producto;";
        } else {
            $sql = "SELECT * from producto WHERE descripcion LIKE '" . $id . "%';";
        }
        return $conexion->query($sql);
    }







}


?>