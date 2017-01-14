<?php
class Elaboracion{

    var $nombre;
    var $mysql;

    function __construct($nombre=null)
    {
        $this->nombre= $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
}
?>

