<?php
class Permiso{
    var $controlador;
    var $accion;
    var $perfil;
    var $mysql;

    function __construct($controlador=null,$accion=null,$perfil=null)
    {
        $this->controlador=$controlador;
        $this->accion=$accion;
        $this->perfil=$perfil;
    }

    public function getControlador()
    {
        return $this->controlador;
    }

    public function getAccion()
    {
        return $this->accion;
    }

    public function getPerfil()
    {
        return $this->perfil;
    }
}

?>