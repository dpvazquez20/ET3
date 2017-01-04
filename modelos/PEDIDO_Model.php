<?php

require('PEDIDO.php');
require_once ('../conectarBD.php');

class Pedido_modelo
{

    var $mysql2;
    var $pedido;

    function __construct()
    {
        $this->mysql2 = conectarBD();
        $this->pedido = new Pedido();

    }

    function altaPedido($pedido)
    {
        $this->mysql = conectarBD();
        $sql = "SELECT * FROM pedido WHERE id_proveedor='" . $pedido->getIDProveedor() . "' AND fecha='" . $pedido->getFecha() . "' ;";
        $resultado = $this->mysql->query($sql);
        if ($resultado->num_rows == 0) {
            $insertar = "INSERT INTO pedido (id_proveedor,id_usuario,fecha) VALUES('" . $pedido->getIDProveedor() . "','" . $pedido->getIDUsuario() . "','" . $pedido->getFecha() . "');";
            $this->mysql->query($insertar);

            return "Se creo el pedido correctamente";
        } else {
            return "El pedido ya existe";
        }
    }


    function deletePedido($id)
    {

        $this->mysql = conectarBD();
        $sql = "DELETE FROM pedido WHERE id='" . $id . "';";
        if ($this->mysql->query($sql)) {
            return "Se ha eliminado correctamente el pedido";

        } else {
            return "Lo sentimos, no se ha podido eliminar el pedido";
        }
    }

    function modifyPedido($id_pedido, $pedidoModificado)
    {
        $this->mysql = conectarBD();
        $sql = "UPDATE pedido SET id_proveedor='" . $pedidoModificado->getIDProveedor() . "',id_usuario='" . $pedidoModificado->getIDUsuario() . "',fecha='" . $pedidoModificado->getFecha() .
            "' WHERE id='" . $id_pedido . "';";
        if ($this->mysql->query($sql)) {
            return "el pedido ha sido modificado correctamente";

        } else {
            return "el pedido ya existe";
        }
    }


    public static function getPedido($idPedido)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM pedido WHERE id ='" . $idPedido . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function listarPedidos()
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM pedido";
        $resul = $conexion->query($sql);
        return $resul;
    }

    /*public static function listarProveedores(){
        $conexion = conectarBD();
        $sql = "SELECT * FROM proveedor";
        $resul = $conexion->query($sql);
        return $resul;
    }*/

    /*public static function listarUsuarios(){

        $conexion = conectarBD();
        $sql = "SELECT * FROM usuario";
        $resul = $conexion->query($sql);
        return $resul;

    }*/


    /*public static function getProveedor($IDProveedor)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM proveedor WHERE id ='" . $IDProveedor . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row;
    }*/

    /*public static function getUsuario($IDUsuario)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM usuario WHERE id_usuario ='" . $IDUsuario . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row;
    }*/


    /*public static function convertirNifProveedor_IDProveedor($nifProveedor)
    {
        $conexion = conectarBD();
        $sql = "SELECT id FROM proveedor WHERE nif ='" . $nifProveedor . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row['id'];
    }

    public static function convertirDNIUsuario_IDUsuario($dniUsuario)
    {
        $conexion = conectarBD();
        $sql = "SELECT id_usuario FROM usuario WHERE DNI ='" . $dniUsuario . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row['id_usuario'];
    }*/
}

?>