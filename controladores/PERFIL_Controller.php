<?php

require_once ('../modelos/PERFIL_Model.php');
require_once ('../vistas/PERFIL_ADD.php');
require_once ('../vistas/PERFIL_DELETE.php');
require_once ('../vistas/PERFIL_SHOW.php');
require_once ('../vistas/PERFIL_SHOWALL.php');
require_once('../vistas/PERFIL_EDIT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');






$controlador="perfil";

switch ($_GET['id']) {

    case 'ADDPERFIL':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['nombre'])) {
                new Perfil_add();
            } else {
                $mayusNombre = strtoupper($_POST['nombre']);
                $perfil = new Perfil($mayusNombre);
                $modelo = new Perfil_modelo();
                $_SESSION['mensaje'] = $modelo->altaPerfil($perfil);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='PERFIL_Controller.php?id=SHOWALLPERFIL&ctr=PERFIL'", 3000)
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


    case 'DELETEPERFIL':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Perfil_delete();
            } else {
                $accion = new Perfil_modelo();
                $_SESSION['mensaje'] =$accion->deletePerfil($_POST['nombreB']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='PERFIL_Controller.php?id=SHOWALLPERFIL&ctr=PERFIL'", 3000)
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

        case'EDITPERFIL':
            $accion="EDIT";
            if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
                if (!isset($_POST['modificar'])) {
                    new Perfil_edit();
                } else {
                    $perfilAModificar = new Perfil($_POST['nombreM']);
                    $modelo = new Perfil_modelo();
                    $_SESSION['mensaje'] =$modelo->modifyPerfil($_POST['nombreAModificar'], $perfilAModificar);
                    new Mensaje_usuario();?>
                    <script language="javascript">
                        setTimeout("location.href='PERFIL_Controller.php?id=SHOWALLPERFIL&ctr=PERFIL'", 3000)
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

    case'SHOWPERFIL':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Perfil_show();
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
            new Perfil_showAll();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }


}

?>