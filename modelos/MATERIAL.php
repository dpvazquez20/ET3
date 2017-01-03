<?php
class Material{
    var $nombre;
    var $descripcion;
    var $mysql;

    function __construct($nombre=null,$descripcion=null)
    {
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}

?>