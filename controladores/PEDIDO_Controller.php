<?php

require_once('../modelos/PEDIDO_Model.php');
require_once('../vistas/PEDIDO_ADD.php');
require_once ('../vistas/PEDIDO_SHOWALL.php');
require_once ('../vistas/PEDIDO_DELETE.php');
require_once('../vistas/PEDIDO_SHOWCURRENT.php');
require_once('../vistas/PEDIDO_EDIT.php');
require_once('../modelos/LINEA_PEDIDO_Model.php');
require_once('../vistas/LINEA_PEDIDO_ADD.php');
require_once ('../vistas/LINEA_PEDIDO_DELETE.php');
require_once('../vistas/LINEA_PEDIDO_SHOWCURRENT.php');
require_once('../vistas/LINEA_PEDIDO_EDIT.php');
require_once ('../vistas/MENSAJE_USUARIO.php');
require_once ('../modelos/PERMISO_Model.php');



$controlador = "pedido";

switch ($_GET['id']) {

    case 'ADDPEDIDO':
        $accion = "ADD";
        if(Permiso_modelo::mostrarPagina($controlador,$accion,$_SESSION['perfil'])) {
            if (!isset($_POST['proveedor'])) {
                new Pedido_add();
            } else {

                $proveedor = $_POST['proveedor'];
                $usuario = $_POST['usuario'];
                $fecha = $_POST['fecha'];

                $pedido = new Pedido($proveedor, $usuario, $fecha);
                $modelo = new Pedido_modelo();
                $_SESSION['mensaje'] = $modelo->altaPedido($pedido);
                new Mensaje_usuario();
            }
        }
        else{
            new Permiso_denegado();
        }
        break;

    case 'DELETEPEDIDO':
        $accion = "DELETE";
        if(Permiso_modelo::mostrarPagina($controlador,$accion,$_SESSION['perfil'])) {
            if (!isset($_POST['borrar'])) {
                new Pedido_delete();
            } else {
                $modelo = new Pedido_modelo();
                $_SESSION['mensaje'] = $modelo->deletePedido($_POST['IDE']);
                new Mensaje_usuario();
            }
        }
        else{
            new Permiso_denegado();
        }
        break;

    case'SHOWPEDIDO':
        $accion = "SHOW";
        if (Permiso_modelo::mostrarPagina($controlador, $accion, $_SESSION['perfil'])) {
            new Pedido_show();
        } else {
            new Permiso_denegado();
        }
        break;

    case'EDITPEDIDO':
        $accion="EDIT";
        if(Permiso_modelo::mostrarPagina($controlador,$accion,$_SESSION['perfil'])) {
            if (!isset($_POST['modificar'])) {
                new Pedido_edit();
            } else {
                $proveedor = $_POST['proveedorM'];
                $usuario = $_POST['usuarioM'];
                $fecha = $_POST['fecha'];

                $pedidoModificado = new Pedido($proveedor, $usuario, $fecha);

                $modelo = new Pedido_modelo();
                $_SESSION['mensaje']=$modelo->modifyPedido($_POST['id_pedido'], $pedidoModificado);
                new Mensaje_usuario();
            }
        }
        else{
            new Permiso_denegado();
        }
        break;

    case'BUSCARPEDIDO':
        break;

    /*case 'SHOWALLPEDIDO':
           new Pedido_showAll();
           break;*/

    case 'ADDLINEAPEDIDO':
        $accion = "SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion,$_SESSION['perfil'])) {
            if (!isset($_POST['nombre_material'])) {
                new Linea_Pedido_add();
            } else {
                $linea = new Linea_Pedido($_POST['nombre_material'], $_POST['id_pedido'], $_POST['cantidad'], $_POST['estado'], $_POST['precio'], $_POST['iva']);
                $idPedido = $_POST['id_pedido'];
                $modelo = new Linea_Pedido_modelo();
                $_SESSION ['mensaje'] = $modelo->altaLineaPedido($linea);
                new Mensaje_usuario();
                /*$dirUrl = 'PEDIDO_Controller.php?id=SHOWPEDIDO&ctr=PEDIDO&idPedido=' . $idPedido;?>
                <script language="javascript">
                    var dirUrl = '<?php echo $dirUrl; ?>';
                    setTimeout("location.href=dirUrl", 3000);
                </script><?php*/
            }
        }
        else{
            /*echo "Permiso denegado"; ?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php*/
            new Permiso_denegado();
        }
        break;


    case 'DELETELINEAPEDIDO':
        $accion = "SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion,$_SESSION['perfil'])) {
            if (!isset($_POST['borrar'])) {
                new Linea_Pedido_delete();
            } else {
                $modelo = new Linea_Pedido_modelo();
                $idPedido = $_POST['IDPedidoE'];
                $_SESSION['mensaje']=$modelo->deleteLineaPedido($_POST['IDE']);
                new Mensaje_usuario();
                /*$dirUrl = 'PEDIDO_Controller.php?id=SHOWPEDIDO&ctr=PEDIDO&idPedido=' . $idPedido;?>
                <script language="javascript">
                    var dirUrl = '<?php echo $dirUrl; ?>';
                    setTimeout("location.href=dirUrl", 3000);
                </script><?php*/
            }
        }else{
            /*echo "Permiso denegado"; ?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php*/

            new Permiso_denegado();
        }
        break;

    case'SHOWLINEAPEDIDO':
        $accion = "SHOW";
        if (Permiso_modelo::mostrarPagina($controlador, $accion, $_SESSION['perfil'])) {
            new Linea_Pedido_show();
        } else {
            /*echo "Permiso denegado"; ?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php*/

            new Permiso_denegado();
        }
        break;

    case'EDITLINEAPEDIDO':
        $accion = "SHOW";
        if(Permiso_modelo::mostrarPagina($controlador,$accion,$_SESSION['perfil'])) {
            if (!isset($_POST['modificar'])) {
                new Linea_Pedido_edit();
            } else {
                $lineaModificado = new Linea_Pedido($_POST['material'], $_POST['id_pedido'], $_POST['cantidad'], $_POST['estado'], $_POST['precio'], $_POST['iva']);
                $modelo = new Linea_Pedido_modelo();
                $_SESSION['mensaje'] = $modelo->modifyLineaPedido($_POST['id_linea'], $lineaModificado);
                $idPedido = $_POST['id_pedido'];
                $dirUrl = 'PEDIDO_Controller.php?id=SHOWPEDIDO&ctr=PEDIDO&idPedido=' . $idPedido;
                /*new Mensaje_usuario(); ?>
                <script language="javascript">
                    var dirUrl = '<?php echo $dirUrl; ?>';
                    setTimeout("location.href=dirUrl", 3000);
                </script><?php*/
            }
        }else{
            /*echo "Permiso denegado"; ?>
            <script language="javascript">
                setTimeout("location.href='../vistas/paginaPorDefecto.php'", 1000)
            </script>
            <?php*/

            new Permiso_denegado();
        }
        break;

    case'BUSCARLINEAPEDIDO':
        break;
    //default: new Linea_Pedido_showAll();



    default:
        if ((Permiso_modelo::mostrarPagina($controlador, $accion = "ADD", $_SESSION['perfil']) == true) ||
            (Permiso_modelo::mostrarPagina($controlador, $accion = "DELETE", $_SESSION['perfil']) == true) ||
            (Permiso_modelo::mostrarPagina($controlador, $accion = "edit", $_SESSION['perfil']) == true) ||
            (Permiso_modelo::mostrarPagina($controlador, $accion = "show", $_SESSION['perfil']) == true)
        ) {
            new Pedido_showAll();
        } else {
            new Permiso_denegado();
        }
}

?>