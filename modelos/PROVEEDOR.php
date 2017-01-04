<?php
class Proveedor{
    var $nombre;
    var $nif;
    var $correoE;
    var $telefono;
    var $direccion;
    var $codigoP;
    var $ciudad;
    var $provincia;
    var $mysql;

    function __construct($nombre=null, $nif=null, $correoE=null, $telefono=null, $direccion=null, $codigoP=null, $ciudad=null, $provincia=null)
    {
        $this->nombre=$nombre;
        $this->nif= $nif;
        $this->correoE=$correoE;
        $this->telefono= $telefono;
        $this->direccion=$direccion;
        $this->codigoP= $codigoP;
        $this->ciudad=$ciudad;
        $this->provincia= $provincia;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getNif()
    {
        return $this->nif;
    }
    public function getCorreoE()
    {
        return $this->correoE;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCodigoP()
    {
        return $this->codigoP;
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }
}

?>