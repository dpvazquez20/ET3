<?php
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../vistas/CONTROLADOR_SHOWALL.php');
require_once ('../vistas/CONTROLADOR_ADD.php');
require_once ('../vistas/CONTROLADOR_DELETE.php');
require_once('../vistas/CONTROLADOR_EDIT.php');
require_once('../vistas/CONTROLADOR_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../vistas/PERMISO_DENEGADO.php');





$controlador="controlador";
switch ($_GET['id']) {

    case 'ADDCONTROLADOR':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['nombre'])) {
                new Controlador_add();
            } else {
                $mayusNombre = strtoupper($_POST['nombre']);
                $controlador = new Controlador($mayusNombre);
                $modelo = new Controlador_modelo();
                $_SESSION['mensaje'] = $modelo->altaControlador($controlador);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();

        }
        break;


    case 'DELETECONTROLADOR':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Controlador_delete();
            } else {
                $modelo = new Controlador_modelo();
                $_SESSION['mensaje'] = $modelo->deleteControlador($_POST['nombreB']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();

        }
        break;

    case'EDITCONTROLADOR':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Controlador_edit();
            } else {
                $controladorModificado = new Controlador($_POST['nombreM']);
                $modelo = new Controlador_modelo();
                $_SESSION['mensaje'] =$modelo->modifyControlador($_POST['nombreAModificar'], $controladorModificado);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();

        }
        break;

    case'SHOWCONTROLADOR':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Controlador_show();
        }else{
            new Permiso_denegado();

        }
        break;


    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Controlador_showAll();
        }else{
            new Permiso_denegado();

        }
}

?>