<?php


require_once ('../vistas/ALBARAN_SHOWALL.php');
require_once ('../modelos/ALBARAN_Model.php');
require_once ('../vistas/ALBARAN_ADD.php');
require_once ('../vistas/LINEA_ALBARAN_ADD.php');
require_once ('../vistas/LINEA_ALBARAN_EDIT.php');
require_once ('../vistas/LINEA_ALBARAN_DELETE.php');
require_once ('../vistas/LINEA_ALBARAN_SHOWCURRENT.php');
require_once ('../vistas/ALBARAN_DELETE.php');
require_once('../vistas/ALBARAN_EDIT.php');
require_once('../vistas/ALBARAN_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../vistas/PERMISO_DENEGADO.php');
require_once ('../vistas/MENSAJE_LINEA_ALBARAN.php');


$controlador="albaran";

switch ($_GET['id']) {
    
    case 'ADDALBARAN':
         $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['enviar'])) {
                new Albaran_add();
            } else {
                $nuevoAlbaran = new Albaran($_POST['pedido'], $_POST['fecha']);
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaAlbaran($nuevoAlbaran);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case 'ADDLINEAALBARAN':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['addlinea'])) {
                new Linea_Albaran_add();
            } else {
                
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaLineaAlbaran($_POST['id_albaran'],$_POST['id_material'], $_POST['cantidad']);
                
                $_SESSION['id_albaran']=$_POST['id_albaran'];
                new Mensaje_linea_albaran();
            }
        }else{
            new Permiso_denegado();
        }

        break;


    


    case 'DELETEALBARAN':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Albaran_delete();
            } else {
            
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteAlbaran($_POST['id_albaran']);
                new Mensaje_usuario();
            }
            
        }else{
            new Permiso_denegado();
        }

        break;

    case 'DELETELINEAALBARAN':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['deletelinea'])) {
                new Linea_Albaran_delete();
            } else {
                
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteLineaAlbaran($_POST['id_linea']);

                $_SESSION['id_albaran']=$_POST['id_albaran'];
                new Mensaje_linea_albaran();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case'EDITALBARAN':

        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Albaran_edit();
            } else {
                $albaranModificado = new Albaran($_POST['id_pedido'], $_POST['fecha']);
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$modelo->updateAlbaran($_POST['id_albaran'], $albaranModificado);
                new Mensaje_usuario();
                         }
        }else{
            new Permiso_denegado();
        }

        break;

    case 'EDITLINEAALBARAN':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['editlinea'])) {

                new Linea_Albaran_edit();
                
            } else {
                
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->editLineaAlbaran($_POST['id_linea'], $_POST['id_albaran'], $_POST['id_material'], $_POST['cantidad'] );

                $_SESSION['id_albaran']=$_POST['id_albaran'];
                new Mensaje_linea_albaran();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case'SHOWALBARAN':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Albaran_show();
        }else{
            new Permiso_denegado();
        }

        break;

    case 'SHOWLINEAALBARAN':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            
            new Linea_Albaran_show();
        }else{
            new Permiso_denegado();
        }

        break;


    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Albaran_showAll();
        }else{
            new Permiso_denegado();
        }

}

?>