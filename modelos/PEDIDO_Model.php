<?php

require('PEDIDO.php');
require_once ('../conectarBD.php');

class Pedido_modelo
{

    var $mysql2;
    var $pedido;

    //constructor de la clase Pedido modelo

    function __construct()
    {
        $this->mysql2 = conectarBD();
        $this->pedido = new Pedido();

    }

    //da de alta un pedido en la base de datos y escribe en el log

    function altaPedido($pedido, $idUsuario){
        $this->mysql = conectarBD();
        $insertar = "INSERT INTO pedido (id_proveedor,id_usuario,fecha) VALUES('" . $pedido->getIDProveedor() . "','" . $pedido->getIDUsuario() . "','" . $pedido->getFecha() . "');";

        if($this->mysql->query($insertar)) {

            $max=self::getMaxIDPedido();
            self::logPedidos($idUsuario,$max,$insertar);

            return "Se creo el pedido correctamente";
        } else{
            return "Lo sentimos, no se ha podido crear el pedido";
        }
    }

    //borra un pedido de la base de datos y escribe en el log


    function deletePedido($id, $idUsuario)
    {

        $this->mysql = conectarBD();
        $sql = "DELETE FROM pedido WHERE id='" . $id . "';";
        if ($this->mysql->query($sql)) {

            self::logPedidos($idUsuario,$id,$sql);

            return "Se ha eliminado correctamente el pedido";

        } else {
            return "Lo sentimos, no se ha podido eliminar el pedido";
        }
    }

    //modifica un pedido de la base de datos y escribe en el log

    function modifyPedido($id_pedido, $pedidoModificado, $idUsuario)
    {
        $this->mysql = conectarBD();
        $sql = "UPDATE pedido SET id_proveedor='" . $pedidoModificado->getIDProveedor() . "',id_usuario='" . $pedidoModificado->getIDUsuario() . "',fecha='" . $pedidoModificado->getFecha() .
            "' WHERE id='" . $id_pedido . "';";
        if ($this->mysql->query($sql)) {

            self::logPedidos($idUsuario,$id_pedido,$sql);

            return "el pedido ha sido modificado correctamente";

        } else {
            return "Lo sentimos, no se ha podido modificar el pedido";
        }
    }

    //devuelve un pedido

    public static function getPedido($idPedido)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM pedido WHERE id ='" . $idPedido . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve todos los pedidos

    public static function listarPedidos()
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM pedido";
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve un pedido según su id

    public static function getIDPedido($id){
        $conexion = conectarBD();
        if ($id == "") {
            $sql = "SELECT * FROM pedido";
        } else {
            $sql = "SELECT * FROM pedido WHERE id LIKE '%".$id."%';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve datos del pedido y proveedor segun el nombre del proveedor

    public static function getNombreProveedorPedido($nombre){
        $conexion = conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM pedido";
        } else {
            $sql = "SELECT pedido.id as id, id_proveedor, id_usuario, fecha, nif FROM proveedor, pedido WHERE pedido.id_proveedor=proveedor.id and proveedor.nombre LIKE '".$nombre."%';";
            }

        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve datos del pedido y proveedor segun el nombre del proveedor

    public static function getNIFProveedorPedido($nif){
        $conexion = conectarBD();
        if ($nif == "") {
            $sql = "SELECT * FROM pedido";
        } else {
            $sql = "SELECT pedido.id as id, id_proveedor, id_usuario, fecha, nif FROM proveedor, pedido WHERE pedido.id_proveedor=proveedor.id and proveedor.nif LIKE '".$nif."%';";
        }

        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve datos del pedido y usuario segun el dni del usuario

    public static function getDNIUsuarioPedido($dni){
        $conexion = conectarBD();
        if ($dni == "") {
            $sql = "SELECT * FROM pedido";
        } else {
            $sql = "SELECT * FROM pedido, usuario WHERE pedido.id_usuario=usuario.id_usuario and usuario.DNI LIKE '".$dni."%';";
        }

        $resul = $conexion->query($sql);
        return $resul;
    }

    //devuelve el id del pedido creado mas recientemente

    public static function getMaxIDPedido(){
        $conexion = conectarBD();
        $sql = "SELECT MAX(id) as id FROM pedido";
        $resul = $conexion->query($sql);

        $max = mysqli_fetch_assoc($resul);

        return $max['id'];


    }

    //devuelve un pedido según la fecha

    public static function getFechaPedido($fecha){
        $conexion = conectarBD();
        if ($fecha == "") {
            $sql = "SELECT * FROM pedido";
        } else {
            $sql = "SELECT * FROM pedido WHERE fecha LIKE '%".$fecha."%';";
        }

        $resul = $conexion->query($sql);
        return $resul;
    }

    //escribe en el log

    public static function logPedidos($userRealID,$pedidoID,$sql){

        $array_date=getDate();
        $date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
        $time=$array_date['hours'].":".$array_date['minutes'].":".$array_date['seconds'];

        $fileName = '../logs/pedidos_log.txt' ;

        if ( !file_exists($fileName) ) {
            print_r ('Archivo no encontrado.');
        }else {
            $texto1 = "Pedido: " . $pedidoID . " ----ID usuario: " . $userRealID . " ----SQL: " . $sql . " ----Fecha:" . $date . " ----Hora:" . $time . PHP_EOL;
            $fp = fopen($fileName, "a");
            if (!$fp) {
                print_r('Archivo no se ha podido abrir.');
            } else {
                fwrite($fp, $texto1);
                fclose($fp);
            }
        }
    }

}

?>