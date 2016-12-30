<?php
 class Usuario{
     var $nombre;
     var $apellido;
     var $dni;
     var $password;
     var $perfil;
     var $borrado;
     var $mysql;

     function __construct($nombre=null, $apellido=null, $dni=null, $password=null, $perfil='usuario')
     {
         $this->nombre=$nombre;
         $this->apellido= $apellido;
         $this->dni=$dni;
         $this->password=$password;
         $this->perfil=$perfil;
     }

     public function getApellido()
     {
         return $this->apellido;
     }

     public function getNombre()
     {
         return $this->nombre;
     }

     public function getDni()
     {
         return $this->dni;
     }

     public function getPassword()
     {
         return $this->password;
     }

     public function getPerfil()
     {
         return $this->perfil;
     }

     public function getBorrado()
     {
         return $this->borrado;
     }

 }

?>