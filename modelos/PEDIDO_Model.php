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

    function altaPedido($pedido){
        $this->mysql = conectarBD();
        $insertar = "INSERT INTO pedido (id_proveedor,id_usuario,fecha) VALUES('" . $pedido->getIDProveedor() . "','" . $pedido->getIDUsuario() . "','" . $pedido->getFecha() . "');";
        $this->mysql->query($insertar);

            return "Se creo el pedido correctamente";

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
            return "Lo sentimos, no se ha podido modificar el pedido";
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
}

?>