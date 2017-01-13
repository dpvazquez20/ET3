<?php
class Pedido{
    var $id_proveedor;
    var $id_usuario;
    var $fecha;
    var $mysql;

    //constructor de la clase Pedido

    function __construct($id_proveedor=null, $id_usuario=null, $fecha=null)
    {
        $this->id_proveedor=$id_proveedor;
        $this->id_usuario=$id_usuario;
        $this->fecha=$fecha;
    }

    //getters de la clase Pedido

    public function getIDProveedor()
    {
        return $this->id_proveedor;
    }

    public function getIDUsuario()
    {
        return $this->id_usuario;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
}

?>