<?php
class Linea_elaboracion{
    var $id_elaboracion;
    var $id_material;
    var $cantidad;
    var $mysql;

    function __construct($id_elaboracion=null, $id_material=null, $cantidad=null)
    {
        $this->id_elaboracion= $id_elaboracion;
        $this->id_material=$id_material;
        $this->cantidad=$cantidad;
    }

    public function getIdElaboracion()
    {
        return $this->id_elaboracion;
    }

    public function getIdMaterial()
    {
        return $this->id_material;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getMysql()
    {
        return $this->mysql;
    }


}

?>