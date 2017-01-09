<?php


require_once ('../vistas/FACTURA_SHOWALL.php');
require_once ('../modelos/FACTURA_Model.php');
require_once ('../modelos/ALBARAN_Model.php');
require_once ('../vistas/FACTURA_ADD.php');
require_once ('../vistas/FACTURA_DELETE.php');
require_once('../vistas/FACTURA_EDIT.php');
require_once('../vistas/FACTURA_SHOWCURRENT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');


$controlador="factura";

switch ($_GET['id']) {
    
    case 'ADDFACTURA':
         $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['enviar'])) {
                new Factura_add();
            } else {
                $nuevoFactura = new Factura($_POST['id_proveedor'],$_POST['NIF'], $_POST['fecha']);
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaFactura($nuevoFactura);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA'", 3000)
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

    case 'ADDLINEAFACTURA':
        $accion="ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['addlinea'])) {
                
            } else {
                
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->altaLineaFactura($_POST['id_factura'],$_POST['id_albaran']);
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    <?php echo 'setTimeout("' . "location.href='FACTURA_Controller.php?id=EDITFACTURA&idFactura=". $_POST['id_factura']. "'". '", 1500)' ?>
                    
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


    


    case 'DELETEFACTURA':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['borrar'])) {
                new Factura_delete();
            } else {
            
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteFactura($_POST['id_factura']);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA'", 3000)
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

    case 'DELETELINEAFACTURA':
        $accion="DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['deletelinea'])) {
                
            } else {
                
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->deleteLineaFactura($_POST['id_linea']);
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    <?php echo 'setTimeout("' . "location.href='FACTURA_Controller.php?id=EDITFACTURA&idFactura=". $_POST['id_factura']. "'". '", 1500)' ?>
                    
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

    case'EDITFACTURA':

        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['modificar'])) {
                new Factura_edit();
            } else {
                $facturaModificada = new Factura($_POST['id_proveedor'],$_POST['NIF'], $_POST['fecha']);
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$modelo->updateFactura($_POST['id_factura'], $facturaModificada);
                new Mensaje_usuario();?>
                <script language="javascript">
                    setTimeout("location.href='FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA'", 3000)
                </script><?php             }
        }else{
            echo"Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }

        break;

    case 'EDITLINEAFACTURA':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            if (!isset($_POST['editlinea'])) {
                
            } else {
                
                $modelo = new Factura_model();
                $_SESSION['mensaje']=$mensaje = $modelo->editLineaFactura($_POST['id_linea'], $_POST['id_factura'], $_POST['id_albaran'] );
                
                new Mensaje_usuario();?>
                <script language="javascript">
                    <?php echo 'setTimeout("' . "location.href='FACTURA_Controller.php?id=EDITFACTURA&idFactura=". $_POST['id_factura']. "'". '", 1500)' ?>
                    
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

    case'SHOWFACTURA':
        $accion="SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion, $_SESSION['perfil'])){
            new Factura_show();
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
            new Factura_showAll();
        }else{
            echo "Permiso denegado";?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php
        }

}

?>