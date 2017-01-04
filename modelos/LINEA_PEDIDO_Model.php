<?php

require('LINEA_PEDIDO.php');
require_once ('../conectarBD.php');
class Linea_Pedido_modelo
{

    var $mysql2;
    var $linea_pedido;

    function __construct()
    {
        $this->mysql2 = conectarBD();
        $this->linea_pedido = new Linea_Pedido();

    }

    function altaLineaPedido($linea_pedido)
    {
        $this->mysql = conectarBD();
        $sql = "SELECT * FROM linea_pedido WHERE id_material='" . $linea_pedido->getIDMaterial() . "' AND id_pedido='" . $linea_pedido->getIDPedido() . "' ;";
        $resultado = $this->mysql->query($sql);
        if ($resultado->num_rows == 0) {
            $insertar = "INSERT INTO linea_pedido (id_material,id_pedido,cantidad,estado,precio,IVA) VALUES('" . $linea_pedido->getIDMaterial() . "','" . $linea_pedido->getIDPedido() . "','" . $linea_pedido->getCantidad() . "','" . $linea_pedido->getEstado() . "','" . $linea_pedido->getPrecio() . "','" . $linea_pedido->getIVA() . "');";
            $this->mysql->query($insertar);
            return "Se creo la linea correctamente";
        } else {
            return "La linea ya existe";
        }
    }


    function deleteLineaPedido($id)
    {

        $this->mysql = conectarBD();
        $sql = "DELETE FROM linea_pedido WHERE id='" . $id . "';";
        if ($this->mysql->query($sql)) {
            return "Se ha eliminado correctamente la linea";
        } else {
            return "Lo sentimos, no se ha podido borrar correctamente la linea";
        }

    }

    function modifyLineaPedido($id_lineaPedido, $lineaModificado)
    {
        $this->mysql = conectarBD();
        $sql = "UPDATE linea_pedido SET id_material='" . $lineaModificado->getIDMaterial() . "',id_pedido='" . $lineaModificado->getIDPedido() . "',cantidad='" . $lineaModificado->getCantidad() . "',estado='" . $lineaModificado->getEstado() . "',precio='" . $lineaModificado->getPrecio() . "',IVA='" . $lineaModificado->getIVA() .
            "' WHERE id='" . $id_lineaPedido . "';";
        if ($this->mysql->query($sql)) {
            return "La linea ha sido modificado correctamente";
        } else {
            return "Lo sentimos, no se ha podido modificar la linea";
        }
    }


    public static function getLineaPedido($idLinea)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM linea_pedido WHERE id ='" . $idLinea . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function listarLineasPedido($idPedido)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM linea_pedido WHERE id_pedido ='" . $idPedido . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    /*public static function getMaterial($idMaterial){

        $conexion = conectarBD();
        $sql = "SELECT * FROM material WHERE id ='" . $idMaterial . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row;
    }

    public static function listarMateriales(){

        $conexion = conectarBD();
        $sql = "SELECT * FROM material";
        $resul = $conexion->query($sql);
        return $resul;

    }*/

 /*   public static function convertirIDMaterial_NombreMaterial($IDM)
    {
        $conexion = conectarBD();
        $sql = "SELECT nombre FROM material WHERE id ='" . $IDM . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row['nombre'];
    }

    public static function convertirNombreMaterial_IDMaterial($nombreM)
    {
        $conexion = conectarBD();
        $sql = "SELECT id FROM material WHERE nombre ='" . $nombreM . "';";
        $resul = $conexion->query($sql);

        $row = mysqli_fetch_assoc($resul);

        return $row['id'];
    }*/

}

?>