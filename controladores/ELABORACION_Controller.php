<?php

require_once ("../vistas/ELABORACION_ADD.php");
require_once ("../vistas/ELABORACION_SHOWCURRENT.php");
require_once ("../vistas/ELABORACION_SHOWALL.php");
require_once ("../vistas/ELABORACION_DELETE.php");
require_once ("../vistas/ELABORACION_EDIT.php");

require_once ("../vistas/LINEA_ELABORACION_ADD.php");
require_once ("../vistas/LINEA_ELABORACION_SHOWCURRENT.php");
require_once ("../vistas/LINEA_ELABORACION_DELETE.php");
require_once ("../vistas/LINEA_ELABORACION_EDIT.php");

require_once ("../vistas/MENSAJE_USUARIO.php");
require_once ("../vistas/MENSAJE_LINEA_ELABORACION.php");
require_once ("../vistas/PERMISO_DENEGADO.php");
require_once ("../modelos/PERMISO_Model.php");
require_once("../modelos/ELABORACION_Model.php");
require_once("../modelos/PRODUCTO_Model.php");
require_once("../modelos/LINEA_ELABORACION_Model.php");

$controlador="elaboracion";



switch ($_GET['id']) {

    case 'ADDELABORACION':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['elaboracion'])) {
                new Elaboracion_add();
            } else {
                echo $_POST['elaboracion'];
                $modelo = new Elaboracion_modelo();
                $elaboracion = new Elaboracion($_POST['elaboracion']);

                $_SESSION['mensaje'] = $modelo->altaElaboracion($elaboracion);

                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'SHOWELABORACION':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Elaboracion_show();
        }else{
            new Permiso_denegado();
        }
        break;

    case 'DELETEELABORACION':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Elaboracion_delete();
            } else {
                $modelo = new Elaboracion_modelo();
                $_SESSION['mensaje'] = $modelo->deleteElaboracion($_POST['elaboracionAEliminar']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'EDITELABORACION':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Elaboracion_edit();
            } else {
                $resul=Producto_modelo::getProducto($_POST['nombreNuevo']);
                $row = mysqli_fetch_assoc($resul);
                $_POST['nombreNuevo']= $row['nombre'];
                $modelo = new Elaboracion_modelo();
                $_SESSION['mensaje'] = $modelo->modifyElaboracion($_POST['nombreNuevo'], $_POST['idElaboracionAModificar']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;


    //CONTROLADORES DE LINEA_ELABORACION -----------------------------
    //----------------------------------------------------------------
    case 'ADDLINEAELABORACION':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['id_elaboracion'])) {
                new Linea_Elaboracion_add();
            } else {
                echo $_POST['elaboracion'];
                $modelo = new Linea_elaboracion_modelo();
                $linea = new Linea_elaboracion($_POST['id_elaboracion'],$_POST['material'],$_POST['cantidad']);

                $_SESSION['mensaje'] = $modelo->altaLineaElaboracion($linea);
                new Mensaje_linea_elaboracion();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'SHOWLINEAELABORACION':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Linea_elaboracion_show();
        }else{
            new Permiso_denegado();
        }
        break;

    case 'DELETELINEAELABORACION':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Linea_Elaboracion_delete();
            } else {
                $modelo = new Linea_elaboracion_modelo();
                $_SESSION['mensaje'] = $modelo->deleteLineaElaboracion($_POST['idE']);
                new Mensaje_linea_elaboracion();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'EDITLINEAELABORACION':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Linea_Elaboracion_edit();
            } else {
                $modelo = new Linea_elaboracion_modelo();
                $_SESSION['mensaje'] = $modelo->modifyLineaElaboracion($_POST['idM'],$_POST['materialM'], $_POST['cantidadM']);
                new Mensaje_linea_elaboracion();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    //----------------------------------------------------------------

    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){

            new Elaboracion_showAll();
        }else{
            new Permiso_denegado();
        }
        break;
}

?>