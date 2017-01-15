<?php
class Stock_producto{

    var $id_producto;
    var $coste;
    var $fecha;
    var $mysql;

    public function __construct($id_producto=null, $fecha=null, $coste=null)
    {
        $this->id_producto= $id_producto;
        $this->coste= $coste;
        $this->fecha= $fecha;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

}

?>