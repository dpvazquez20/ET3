<?php


require_once ('../vistas/STOCK_MATERIAL_SHOWALL.php');
require_once ('../modelos/STOCK_MATERIAL_Model.php');
require_once ('../vistas/STOCK_MATERIAL_ADD.php');
require_once ('../vistas/STOCK_MATERIAL_DELETE.php');
require_once('../vistas/STOCK_MATERIAL_EDIT.php');
require_once('../vistas/STOCK_MATERIAL_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');


$controlador="stock_material";

switch ($_GET['id']) {
    
    case 'ADDSTOCK_MATERIAL':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
             if (!isset($_POST['Id_material'])) {
                new Stock_material_add();

            } else {
                $modelo = new Stock_material_modelo();
                $stock = new Stock_material($_POST['Id_material'], $_POST['Id_albaran'], $_POST['Id_producto']);

                $_SESSION['mensaje'] = $modelo->altaStock_material($stock);
                
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;


    case 'DELETESTOCK_MATERIAL':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Stock_material_delete();
            } else {
                $modelo = new Stock_material_modelo();
                
                $_SESSION['mensaje'] = $modelo->deleteStock_material($_POST['idB']);
                
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'EDITSTOCK_MATERIAL':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Stock_material_edit();
            } else {
                $modelo = new Stock_material_modelo();
                $_SESSION['mensaje'] = $modelo->modifyStock_material($_POST['idB'],$_POST['id_materialM'],$_POST['id_albaranM'], $_POST['id_productoM']);
                new Mensaje_usuario();
            }
        }else{
            new Permiso_denegado();
        }
        break;

    case'SHOWSTOCK_MATERIAL':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Stock_material_show();
        }else{
            new Permiso_denegado();
        }
        break;


    default:
        
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Stock_material_showAll();
        }else{
            new Permiso_denegado();
        }

}

?>