<?php


require_once ('../vistas/STOCK_PRODUCTO_SHOWALL.php');
require_once ('../vistas/STOCK_PRODUCTO_ADD.php');
require_once ('../vistas/STOCK_PRODUCTO_DELETE.php');
require_once('../vistas/STOCK_PRODUCTO_EDIT.php');
require_once('../vistas/STOCK_PRODUCTO_SHOWCURRENT.php');


require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../modelos/STOCK_PRODUCTO_Model.php');
require_once ('../modelos/PRODUCTO_Model.php');

$controlador="stock_producto";

switch ($_GET['id']) {

    case 'ADDSTOCK_PRODUCTO':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['material'])) {
                new Stock_producto_add();
            } else {

                $modelo = new Stock_producto_modelo();
                $stock = new Stock_producto($_POST['material'],$_POST['fecha'],$_POST['precio'] );
                $_SESSION['mensaje'] = $modelo->altaStock_producto($stock);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;


    case 'DELETESTOCK_PRODUCTO':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Stock_producto_delete();
            } else {
                $modelo = new Stock_producto_modelo();

                $_SESSION['mensaje'] = $modelo->deleteStock_producto($_POST['idB']);

                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'EDITSTOCK_PRODUCTO':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Stock_producto_edit();
            } else {
                $modelo = new Stock_producto_modelo();
                echo $_POST['productoM'];
                $_SESSION['mensaje'] = $modelo->modifyStock_producto($_POST['idM'],$_POST['productoM'],$_POST['precioM'], $_POST['fechaM']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'SHOWSTOCK_PRODUCTO':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Stock_producto_show();
        }else{
            new Permiso_denegado();
        }
        break;


    default:

        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Stock_producto_showAll();
        }else{
            new Permiso_denegado();
        }

}

?>