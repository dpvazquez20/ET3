<?php


require_once ('../vistas/FACTURA_SHOWALL.php');
require_once ('../modelos/FACTURA_Model.php');
require_once ('../modelos/ALBARAN_Model.php');
require_once ('../vistas/FACTURA_ADD.php');
require_once ('../vistas/LINEA_FACTURA_ADD.php');
require_once ('../vistas/LINEA_FACTURA_EDIT.php');
require_once ('../vistas/LINEA_FACTURA_DELETE.php');
require_once ('../vistas/LINEA_FACTURA_SHOWCURRENT.php');
require_once ('../vistas/FACTURA_DELETE.php');
require_once('../vistas/FACTURA_EDIT.php');
require_once('../vistas/FACTURA_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../vistas/PERMISO_DENEGADO.php');
require_once ("../vistas/MENSAJE_LINEA_FACTURA.php");


$controlador="factura";

switch ($_GET['id']) {
    
    case 'ADDFACTURA':
         $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['enviar'])) {
                new Factura_add();
            } else {
                $nuevoFactura = new Factura($_POST['id_proveedor'],$_POST['NIF'], $_POST['fecha']);
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaFactura($nuevoFactura);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case 'ADDLINEAFACTURA':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['addlinea'])) {

                new Linea_Factura_Add();
                
            } else {
                
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaLineaFactura($_POST['id_factura'],$_POST['id_albaran']);
                
                $_SESSION['id_factura']=$_POST['id_factura'];
                new Mensaje_linea_factura();
            }
        }else{
            new Permiso_denegado();
        }

        break;


    


    case 'DELETEFACTURA':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Factura_delete();
            } else {
            
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteFactura($_POST['id_factura']);
                new Mensaje_usuario();
            }
            
        }else{
            new Permiso_denegado();
        }

        break;

    case 'DELETELINEAFACTURA':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['deletelinea'])) {
                new Linea_Factura_delete();
                
            } else {
                
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteLineaFactura($_POST['id_linea']);

                $_SESSION['id_factura']=$_POST['id_factura'];
                new Mensaje_linea_factura();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case'EDITFACTURA':

        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Factura_edit();
            } else {
                $facturaModificada = new Factura($_POST['id_proveedor'],$_POST['NIF'], $_POST['fecha']);
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$modelo->updateFactura($_POST['id_factura'], $facturaModificada);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case 'EDITLINEAFACTURA':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['editlinea'])) {
                new Linea_Factura_edit();
                
            } else {
                
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->editLineaFactura($_POST['id_linea'], $_POST['id_factura'], $_POST['id_albaran'] );

                $_SESSION['id_factura']=$_POST['id_factura'];
                new Mensaje_linea_factura();
            }
        }else{
            new Permiso_denegado();
        }

        break;

    case'SHOWFACTURA':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Factura_show();
        }else{
            new Permiso_denegado();
        }
        break;

      case 'SHOWLINEAFACTURA':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            
            new Linea_Factura_show();
        }else{
            new Permiso_denegado();
        }

        break;


    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Factura_showAll();
        }else{
            new Permiso_denegado();
        }

}

?>