<?php

require_once ('../vistas/ACCION_SHOWALL.php');
require_once ('../modelos/ACCION_Model.php');
require_once ('../vistas/ACCION_ADD.php');
require_once ('../vistas/ACCION_DELETE.php');
require_once ('../vistas/ACCION_SHOW.php');
require_once('../vistas/ACCION_EDIT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');
$controlador="accion";
switch ($_GET['id']) {
    case 'ADDACCION':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['nombre'])) {
                new Accion_add();
            } else {
                $mayusNombre = strtoupper($_POST['nombre']);
                $accion = new Accion($mayusNombre);
                $modelo = new Accion_modelo();
                $_SESSION['mensaje'] = $modelo->altaAccion($accion);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='ACCION_Controller.php?id=SHOWALLACCION&ctr=ACCION'", 3000)
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


    case 'DELETEACCION':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Accion_delete();
            } else {
                $accion = new Accion_modelo();
                $_SESSION['mensaje'] = $accion->deleteAccion($_POST['nombreB']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='ACCION_Controller.php?id=SHOWALLACCION&ctr=ACCION'", 3000)
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

    case'EDITACCION':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Accion_edit();
            } else {
                $accionAModificar = new Accion($_POST['nombreM']);
                $modelo = new Accion_modelo();
                $_SESSION['mensaje'] = $modelo->modifyAccion($_POST['nombreAModificar'], $accionAModificar);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='ACCION_Controller.php?id=SHOWALLACCION&ctr=ACCION'", 3000)
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

    case'SHOWACCION':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Accion_show();
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
            new Accion_showAll();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }

}

?>