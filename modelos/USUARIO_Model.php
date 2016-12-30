<?php

require('USUARIO.php');
require_once ('../conectarBD.php');
class Usuario_modelo{

    var $mysql2;
    var $usuario;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->usuario= new Usuario();

    }

    function altaUsuario($usuario){
        $this->mysql = conectarBD();
        $sql= "SELECT * FROM usuario WHERE DNI='".$usuario->getDni()."';";
        $resultado= $this->mysql->query($sql);
        if($resultado->num_rows==0){
            $insertar= "INSERT INTO usuario (nombre,apellido,DNI,password,perfil) VALUES('".$usuario->getNombre()."','".$usuario->getApellido()."','".$usuario->getDni()."','".$usuario->getPassword()."','".$usuario->getPerfil()."');";
            $this->mysql->query($insertar);

            return "Se creo el usuario correctamente";
        }
        else{
                $row= mysqli_fetch_assoc($resultado);
                if($row['borrado']=="0"){
                    return "El usuario ya existe";
                }else{
                    $sql ="UPDATE usuario SET borrado='0' WHERE DNI='".$usuario->getDni()."';";
                    $this->mysql->query($sql);
                    return "Se creo el usuario correctamente";
                }
        }
     }

        function deleteUsuario($dni){

            $this->mysql = conectarBD();
            $sql = "UPDATE usuario SET borrado='1' WHERE DNI='".$dni."';";
            if($this->mysql->query($sql)){
                return "Usuario borrado correctamente";
            }else{
                return "Lo sentimos el usuario no se ha podido borrar";
            }

        }
        function modifyUsuario($id_usuario,$usuarioModificado){
            $this->mysql= conectarBD();
            $sqlComprobacion="SELECT * FROM usuario where DNI='".$usuarioModificado->getDni()."'AND id_usuario!='".$id_usuario."'";
            $resul=$this->mysql->query($sqlComprobacion);
            if($resul->num_rows==0) {
                $sql = "UPDATE usuario SET nombre='" . $usuarioModificado->getNombre() . "',Apellido='" . $usuarioModificado->getApellido() . "',DNI='" . $usuarioModificado->getDni() .
                    "', password='" . $usuarioModificado->getPassword() . "',perfil='" . $usuarioModificado->getPerfil() . "' WHERE id_usuario='" . $id_usuario . "';";
                $this->mysql->query($sql);
                return "El usuario ha sido modificado correctamente";
            }else{
                return "Lo sentimos, ese usuario ya existe";
            }
        }

   public static function listar()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM usuario WHERE borrado='0'";
        $resul = $conexion->query($sql);
        return $resul;
    }
    public static function getUsuarioPerfil($perfil)
    {
        $conexion = conectarBD();
        if ($perfil == "") {
            $sql = "SELECT * FROM usuario WHERE borrado='0'";
        } else {
            $sql = "SELECT * FROM usuario WHERE perfil='" . $perfil . "' AND borrado='0';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }
}

function getUsuario($idUsuario){
    $conexion = conectarBD();
    $sql = "SELECT * FROM usuario WHERE id_usuario='".$idUsuario."' AND borrado='0';";
    $resul = $conexion->query($sql);
    return $resul;
}





?>