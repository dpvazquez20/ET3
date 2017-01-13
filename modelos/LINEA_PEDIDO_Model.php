<?php

require('LINEA_PEDIDO.php');
require_once ('../conectarBD.php');
class Linea_Pedido_modelo
{

    var $mysql2;
    var $linea_pedido;

    //constructor de la clase Linea de Pedido modelo

    function __construct()
    {
        $this->mysql2 = conectarBD();
        $this->linea_pedido = new Linea_Pedido();

    }

    //da de alta una linea de pedidos en la base de datos y escribe en el log

    function altaLineaPedido($linea_pedido, $idUsuario)
    {
        $this->mysql = conectarBD();
        $insertar = "INSERT INTO linea_pedido (id_material,id_pedido,cantidad,estado,precio,IVA) VALUES('" . $linea_pedido->getIDMaterial() . "','" . $linea_pedido->getIDPedido() . "','" . $linea_pedido->getCantidad() . "','" . $linea_pedido->getEstado() . "','" . $linea_pedido->getPrecio() . "','" . $linea_pedido->getIVA() . "');";
        if ($this->mysql->query($insertar)) {

            $max=self::getMaxIDLineaPedido();
            self::logLineaPedidos($idUsuario,$linea_pedido->getIDPedido(),$max,$insertar);

            return "Se ha añadido correctamente la linea";
        } else {
            return "Lo sentimos, no se ha podido añadir correctamente la linea";
        }
    }

    //borra una linea de pedidos en la base de datos y escribe en el log

    function deleteLineaPedido($id, $idPedido, $idUsuario)
    {

        $this->mysql = conectarBD();
        $sql = "DELETE FROM linea_pedido WHERE id='" . $id . "';";
        if ($this->mysql->query($sql)) {

            self::logLineaPedidos($idUsuario,$idPedido,$id,$sql);

            return "Se ha eliminado correctamente la linea";

        } else {
            return "Lo sentimos, no se ha podido borrar correctamente la linea";
        }

    }

    //modifica una linea de pedidos en la base de datos y escribe en el log

    function modifyLineaPedido($id_lineaPedido, $lineaModificado, $idUsuario)
    {
        $this->mysql = conectarBD();
        $sql = "UPDATE linea_pedido SET id_material='" . $lineaModificado->getIDMaterial() . "',id_pedido='" . $lineaModificado->getIDPedido() . "',cantidad='" . $lineaModificado->getCantidad() . "',estado='" . $lineaModificado->getEstado() . "',precio='" . $lineaModificado->getPrecio() . "',IVA='" . $lineaModificado->getIVA() .
            "' WHERE id='" . $id_lineaPedido . "';";
        if ($this->mysql->query($sql)) {

            self::logLineaPedidos($idUsuario,$lineaModificado->getIDPedido(),$id_lineaPedido,$sql);

            return "La linea ha sido modificado correctamente";
        } else {
            return "Lo sentimos, no se ha podido modificar la linea";
        }
    }

    //devuelve una linea de pedidos

    public static function getLineaPedido($idLinea)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM linea_pedido WHERE id ='" . $idLinea . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve todas las lineas de pedidos de una factura de la base de datos

    public static function listarLineasPedido($idPedido)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM linea_pedido WHERE id_pedido ='" . $idPedido . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve el Id de la linea de pedido generado mas recientemente

    public static function getMaxIDLineaPedido(){
        $conexion = conectarBD();
        $sql = "SELECT MAX(id) as id FROM linea_pedido";
        $resul = $conexion->query($sql);

        $max = mysqli_fetch_assoc($resul);

        return $max['id'];


    }

    //escribe en el log

    public static function logLineaPedidos($userRealID,$pedidoID,$lineaID,$sql){

        $array_date=getDate();
        $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
        $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];

        $fileName = '../logs/pedidos_log.txt' ;

        if ( !file_exists($fileName) ) {
            print_r ('Archivo no encontrado.');
        }else {
            $texto1 = "Pedido: " . $pedidoID . " ----Linea ID: " . $lineaID . " ----ID usuario: " . $userRealID . " ----SQL: " . $sql . " ----Fecha:" . $date . " ----Hora:" . $time . PHP_EOL;
            $fp = fopen($fileName, "a");
            if (!$fp) {
                print_r('Archivo no se ha podido abrir.');
            }else {
                fwrite($fp, $texto1);
                fclose($fp);
            }
        }

    }



}

?>