<?php



require_once('../modelos/USUARIO_Model.php');
require_once('../vistas/USUARIO_ADD.php');
require_once ('../vistas/USUARIO_SHOWALL.php');
require_once ('../modelos/USUARIO_Model.php');
require_once ('../vistas/USUARIO_DELETE.php');
require_once('../vistas/USUARIO_SHOWCURRENT.php');
require_once('../vistas/USUARIO_EDIT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../vistas/PERMISO_DENEGADO.php');


$controlador = "usuario";
switch ($_GET['id']) {



    case 'ADDUSUARIO':

        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
        if (!isset($_POST['nombre'])) {
            new Usuario_add();
        } else {
            $_POST['password']= md5($_POST['password']);
            $usuario = new Usuario($_POST['nombre'], $_POST['apellido'], $_POST['DNI'], $_POST['password'], $_POST['perfil']);
            $modelo = new Usuario_modelo();
            $_SESSION['mensaje'] = $modelo->altaUsuario($usuario);
            new Mensaje_usuario();

        }
            }else {
           new Permiso_denegado();
        }

        break;

    case 'DELETEUSUARIO':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Usuario_delete();
            } else {
                $modelo = new Usuario_modelo();
                $_SESSION['mensaje']=&$modelo->deleteUsuario($_POST['DNIE']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();


        }
        break;
    case'SHOWUSUARIO':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Usuario_show();
        }else{
            new Permiso_denegado();

        }
        break;

    case'EDITUSUARIO':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Usuario_edit();
            } else {
                $_POST['passwordM']= md5($_POST['passwordM']);
                $usuarioModificado = new Usuario($_POST['nombreM'], $_POST['apellidoM'], $_POST['DNIM'], $_POST['passwordM'], $_POST['perfilM']);
                $modelo = new Usuario_modelo();
                $_SESSION['mensaje']=$modelo->modifyUsuario($_POST['id_usuario'], $usuarioModificado);
                new Mensaje_usuario();         }
        }else{
            new Permiso_denegado();
        }
        break;

    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Usuario_showAll();
        }else{
            new Permiso_denegado();

        }
}


?>



