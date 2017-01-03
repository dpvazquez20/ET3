<?php
class Stock_material{
    
    var $id_material;
    var $id_albaran;
    var $id_producto;
    var $mysql;

    function __construct($id_material=null,$id_albaran=null,$id_producto=null)
    {
        $this->id_material=$id_material;
        $this->id_albaran=$id_albaran;
        $this->id_producto=$id_producto;
    }
    
    public function getId_material()
    {
        return $this->id_material;
    }
    
    public function getId_albaran()
    {
        return $this->id_albaran;
    }
    
    public function getId_producto()
    {
        return $this->id_producto;
    }
}

?>