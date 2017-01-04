<?php
class Linea_Pedido{
    var $id_material;
    var $id_pedido;
    var $cantidad;
    var $estado;
    var $precio;
    var $IVA;
    var $mysql;

    function __construct($id_material=null, $id_pedido=null, $cantidad=null, $estado=null, $precio=null, $IVA=null)
    {
        $this->id_material=$id_material;
        $this->id_pedido=$id_pedido;
        $this->cantidad=$cantidad;
        $this->estado=$estado;
        $this->precio=$precio;
        $this->IVA=$IVA;
    }

    public function getIDMaterial()
    {
        return $this->id_material;
    }

    public function getIDPedido()
    {
        return $this->id_pedido;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function getEstado()
    {
        return $this->estado;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getIVA()
    {
        return $this->IVA;
    }
}

?>