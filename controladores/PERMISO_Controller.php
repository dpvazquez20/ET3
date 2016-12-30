<?php


require_once ('../vistas/PERMISO_SHOWALL.php');
require_once ('../modelos/PERMISO_Model.php');
require_once ('../vistas/PERMISO_ADD.php');
require_once ('../vistas/PERMISO_DELETE.php');
require_once('../vistas/PERMISO_EDIT.php');
require_once ('../vistas/PERMISO_SHOW.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');


$controlador="permiso";

switch ($_GET['id']) {

    case 'ADDPERMISO':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['enviar'])) {
                new Permiso_add();
            } else {
                $nuevoPermiso = new Permiso($_POST['controlador'], $_POST['accion'], $_POST['perfil']);
                $modelo = new Permiso_modelo();
                $_SESSION['mensaje']=$mensaje = $modelo->altAPermiso($nuevoPermiso);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='PERMISO_Controller.php?id=SHOWALLPERMISO&ctr=PERMISO'", 3000)
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

    case 'DELETEPERMISO':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){

            if (!isset($_POST['borrar'])) {
                new Permiso_delete();
            } else {
                $modelo = new Permiso_modelo();
                $_SESSION['mensaje']=$mensaje = $modelo->deletePermiso($_POST['id_permiso']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='PERMISO_Controller.php?id=SHOWALLPERMISO&ctr=PERMISO'", 3000)
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

    case'EDITPERMISO':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Permiso_edit();
            } else {
                $permisoAModificar = new Permiso($_POST['controladorM'], $_POST['accionM'], $_POST['perfilM']);
                $modelo = new Permiso_modelo();
                $_SESSION['mensaje']=$modelo->modifyPermiso($permisoAModificar, $_POST['id_permiso']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='PERMISO_Controller.php?id=SHOWALLPERMISO&ctr=PERMISO'", 3000)
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


    case'SHOWPERMISO':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Permiso_show();
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
             new Permiso_showAll();
        }else{
                echo "Permiso denegado";?>
                <script language="javascript">
                    setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
                </script>
                <?php
        }

}

?>