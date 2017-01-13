<?php
class Factura{
    var $id_proveedor;
    var $NIF;
    var $fecha;
    var $mysql;

    function __construct($id_proveedor=null,$NIF=null,$fecha=null)
    {
        $this->id_proveedor=$id_proveedor;
        $this->NIF = $NIF;
        $this->fecha=$fecha;
 
    }

    public function getIdProveedor()
    {
        return $this->id_proveedor;
    }

    public function getNIF()
    {
        return $this->NIF;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

}

class LineaFactura{
    var $id_albaran;
    var $id_factura;
    var $mysql;

     function __construct($id_albaran=null,$id_factura=null)
    {
        $this->id_albaran=$id_albaran;
        $this->id_factura=$id_factura;
    
 
    }
}

?>