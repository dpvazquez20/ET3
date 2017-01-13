<?php
class Albaran{
    var $id_pedido;
    var $fecha;
    var $mysql;

    function __construct($id_pedido=null,$fecha=null)
    {
        $this->id_pedido=$id_pedido;
        $this->fecha=$fecha;
 
    }

    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

}

class LineaAlbaran{
    var $id_albaran;
    var $id_material;
    var $cantidad;
    var $mysql;

     function __construct($id_albaran=null,$id_material=null, $cantidad=null)
    {
        $this->id_albaran=$id_albaran;
        $this->id_material=$id_material;
        $this->cantidad=$cantidad;
 
    }
}

?>