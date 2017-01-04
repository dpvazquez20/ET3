<?php

require_once('../modelos/PROVEEDOR_Model.php');
require_once('../vistas/PROVEEDOR_ADD.php');
require_once ('../vistas/PROVEEDOR_SHOWALL.php');
require_once ('../vistas/PROVEEDOR_DELETE.php');
require_once('../vistas/PROVEEDOR_SHOWCURRENT.php');
require_once('../vistas/PROVEEDOR_EDIT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../vistas/PERMISO_DENEGADO.php');



$controlador="proveedor";

switch ($_GET['id']) {

    case 'ADDPROVEEDOR':
        $accion = "ADD";
        if (Permiso_modelo::mostrarPagina($controlador, $accion, $_SESSION['perfil'])) {
            if (!isset($_POST['nombre'])) {
                new Proveedor_add();
            } else {
                $proveedor = new Proveedor($_POST['nombre'], $_POST['NIF'],$_POST['correoE'], $_POST['telefono'],$_POST['direccion'], $_POST['codigoP'],$_POST['ciudad'], $_POST['provincia']);
                $modelo = new Proveedor_modelo();
                $_SESSION['mensaje'] = $modelo->altaProveedor($proveedor);
                new Mensaje_usuario();
            }
        } else {
            new Permiso_denegado();
        }
        break;

    case 'DELETEPROVEEDOR':
        $accion = "DELETE";
        if (Permiso_modelo::mostrarPagina($controlador, $accion, $_SESSION['perfil'])) {
            if (!isset($_POST['borrar'])) {
                new Proveedor_delete();
            } else {
                $modelo = new Proveedor_modelo();
                $_SESSION['mensaje'] = $modelo->deleteProveedor($_POST['IDE']);
                new Mensaje_usuario();

            }
        } else {
           new Permiso_denegado();
        }
        break;

    case'SHOWPROVEEDOR':
        $accion = "SHOW";
        if (Permiso_modelo::mostrarPagina($controlador, $accion, $_SESSION['perfil'])) {
            new Proveedor_show();
        } else {
            new Permiso_denegado();
        }
        break;

    case'EDITPROVEEDOR':
        $accion = "EDIT";
        if (Permiso_modelo::mostrarPagina($controlador, $accion, $_SESSION['perfil'])) {
            if (!isset($_POST['modificar'])) {
                new Proveedor_edit();
            } else {
                $proveedorModificado = new Proveedor($_POST['nombreM'], $_POST['NIFM'], $_POST['correoEM'], $_POST['telefonoM'],$_POST['direccionM'], $_POST['codigoPM'],$_POST['ciudadM'], $_POST['provinciaM']);
                $modelo = new Proveedor_modelo();
                $_SESSION['mensaje'] = $modelo->modifyProveedor($_POST['id_proveedor'], $proveedorModificado);
                new Mensaje_usuario();
            }
        } else {
            new Permiso_denegado();
        }
        break;

    case'BUSCARPROVEEDOR':
        break;

    /*case 'SHOWALLPROVEEDOR':
        new Proveedor_showAll();
        break;*/

    default:
        if ((Permiso_modelo::mostrarPagina($controlador, $accion = "ADD", $_SESSION['perfil']) == true) ||
            (Permiso_modelo::mostrarPagina($controlador, $accion = "DELETE", $_SESSION['perfil']) == true) ||
            (Permiso_modelo::mostrarPagina($controlador, $accion = "edit", $_SESSION['perfil']) == true) ||
            (Permiso_modelo::mostrarPagina($controlador, $accion = "show", $_SESSION['perfil']) == true)
        ) {
            new Proveedor_showAll();
        } else {
           new Permiso_denegado();
        }
}

?>
