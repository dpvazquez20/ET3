<?php


require_once ('../vistas/ALBARAN_SHOWALL.php');
require_once ('../modelos/ALBARAN_Model.php');
require_once ('../vistas/ALBARAN_ADD.php');
require_once ('../vistas/ALBARAN_DELETE.php');
require_once('../vistas/ALBARAN_EDIT.php');
require_once('../vistas/ALBARAN_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');


$controlador="albaran";

switch ($_GET['id']) {
    
    case 'ADDALBARAN':
         $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['enviar'])) {
                new Albaran_add();
            } else {
                $nuevoAlbaran = new Albaran($_POST['pedido'], $_POST['fecha']);
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaAlbaran($nuevoAlbaran);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN'", 3000)
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

    case 'ADDLINEAALBARAN':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['addlinea'])) {
                
            } else {
                
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaLineaAlbaran($_POST['id_albaran'],$_POST['id_material'], $_POST['cantidad']);
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    <?php echo 'setTimeout("' . "location.href='ALBARAN_Controller.php?id=EDITALBARAN&idAlbaran=". $_POST['id_albaran']. "'". '", 1500)' ?>
                    
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


    


    case 'DELETEALBARAN':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Albaran_delete();
            } else {
            
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteAlbaran($_POST['id_albaran']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN'", 3000)
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

    case 'DELETELINEAALBARAN':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['deletelinea'])) {
                
            } else {
                
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteLineaAlbaran($_POST['id_linea']);
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    <?php echo 'setTimeout("' . "location.href='ALBARAN_Controller.php?id=EDITALBARAN&idAlbaran=". $_POST['id_albaran']. "'". '", 1500)' ?>
                    
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

    case'EDITALBARAN':

        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Albaran_edit();
            } else {
                $albaranModificado = new Albaran($_POST['id_pedido'], $_POST['fecha']);
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$modelo->updateAlbaran($_POST['id_albaran'], $albaranModificado);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN'", 3000)
                </script><?php             }
        }else{
            echo"Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }

        break;

    case 'EDITLINEAALBARAN':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['editlinea'])) {
                
            } else {
                
                $modelo = new Albaran_model();
                $_SESSION['mensaje']=$mensaje = $modelo->editLineaAlbaran($_POST['id_linea'], $_POST['id_albaran'], $_POST['id_material'], $_POST['cantidad'] );
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    <?php echo 'setTimeout("' . "location.href='ALBARAN_Controller.php?id=EDITALBARAN&idAlbaran=". $_POST['id_albaran']. "'". '", 1500)' ?>
                    
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

    case'SHOWALBARAN':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Albaran_show();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }
        break;

        break;


    default:
        if((Permiso_modelo::mostrarPagina($controlador,$accion="ADD", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="DELETE", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="EDIT", $_SESSION['perfil'])==true) ||
            (Permiso_modelo::mostrarPagina($controlador,$accion="SHOW", $_SESSION['perfil'])==true) ){
            new Albaran_showAll();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }

}

?>