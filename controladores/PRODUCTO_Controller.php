<?php
require_once ("../vistas/PRODUCTO_ADD.php");
require_once ("../vistas/PRODUCTO_SHOWCURRENT.php");
require_once ("../vistas/PRODUCTO_DELETE.php");
require_once ("../vistas/PRODUCTO_EDIT.php");
require_once ("../vistas/PRODUCTO_SHOWALL.php");
require_once ("../modelos/PERMISO_Model.php");
require_once ("../modelos/PRODUCTO_Model.php");
require_once ("../vistas/MENSAJE_USUARIO.php");
require_once ("../vistas/PERMISO_DENEGADO.php");

$controlador="producto";

switch ($_GET['id']) {

    case 'ADDPRODUCTO':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['nombre'])) {
                new Producto_add();
            } else {
                $modelo = new Producto_modelo();
                $producto = new Producto($_POST['nombre'], $_POST['descripcion']);

                $_SESSION['mensaje'] = $modelo->altaProducto($producto);

                new Mensaje_usuario();
            }
        }else{
                new Permiso_denegado();
        }
        break;


    case 'DELETEPRODUCTO':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Producto_delete();
            } else {
                $modelo = new Producto_modelo();
                $_SESSION['mensaje'] = $modelo->deleteProducto($_POST['productoAModificar']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'EDITPRODUCTO':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Producto_edit();
            } else {
                $modelo = new Producto_modelo();
                $_SESSION['mensaje'] = $modelo->modifyProducto($_POST['nombreM'],$_POST['descripcionM'], $_POST['productoAModificar']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'SHOWPRODUCTO':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Producto_show();
        }else{
            new Permiso_denegado();
        }
        break;


    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Producto_showAll();
        }else{
            new Permiso_denegado();
        }
        break;
}

?>