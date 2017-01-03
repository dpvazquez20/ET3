<?php


require_once ('../vistas/MATERIAL_SHOWALL.php');
require_once ('../modelos/MATERIAL_Model.php');
require_once ('../vistas/MATERIAL_ADD.php');
require_once ('../vistas/MATERIAL_DELETE.php');
require_once('../vistas/MATERIAL_EDIT.php');
require_once('../vistas/MATERIAL_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');


$controlador="material";

switch ($_GET['id']) {
    
    case 'ADDMATERIAL':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
             if (!isset($_POST['nombre'])) {
                new Material_add();
            } else {
                $modelo = new Material_modelo();
                $material = new Material($_POST['nombre'], $_POST['descripcion']);

                $_SESSION['mensaje'] = $modelo->altaMaterial($material);
                
                new Mensaje_usuario();?>
                
                <script language="javascript">
                    setTimeout("location.href='MATERIAL_Controller.php?id=SHOWALLMATERIAL&ctr=MATERIAL'", 1000)
                </script><?php
            }
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }
        break;


    case 'DELETEMATERIAL':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Material_delete();
            } else {
                $modelo = new Material_modelo();
                
                $_SESSION['mensaje'] = $modelo->deleteMaterial($_POST['idB']);
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='MATERIAL_Controller.php?id=SHOWALLMATERIAL&ctr=MATERIAL'", 1000)
                </script><?php
            }
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }
        break;

    case'EDITMATERIAL':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Material_edit();
            } else {
                $modelo = new Material_modelo();
                $_SESSION['mensaje'] = $modelo->modifyMaterial($_POST['nombreM'],$_POST['descripcionM'], $_POST['idB']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='MATERIAL_Controller.php?id=SHOWALLMATERIAL&ctr=MATERIAL'", 1000)
                </script><?php
            }
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }
        break;

    case'SHOWMATERIAL':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Material_show();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }
        break;


    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Material_showAll();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }

}

?>