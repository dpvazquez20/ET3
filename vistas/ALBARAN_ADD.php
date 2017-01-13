<?php

require_once ('../modelos/ALBARAN_Model.php');
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/PERFIL_Model.php');
if(!isset($_SESSION)){
    session_start();
}
class Albaran_add{

    function __construct(){
        $this->render();
    }

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">
            <title> <?php echo $literales['añadirAlbaran'] ?></title>
             <script>
                    $( function() {
                        $( "#fecha" ).datepicker({dateFormat: "yy-mm-dd"});
                    } );
            </script>
                <div class="alert alert-info"><?php echo $literales['albaranADD']?> </div>

                <form role="form" action="ALBARAN_Controller.php?id=ADDALBARAN&ctr=ALBARAN" method="POST">

                    <!-- Seleccion del pedido-->
                    <div class="form-group">
                        <label for="pedido"><?php  echo $literales['idPedido']?></label>
                        <select id="pedido" name="pedido"style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PEDIDO
                            $pedidos= Albaran_Model::listarPedidos();
                            while($row = mysqli_fetch_assoc($pedidos)){
                                echo "<option value='".$row['id']."' >".$row['id']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                <!-- Seleccion de la fecha-->
                    <div class="form-group">
                            <label for="fecha"><?php  echo $literales['inputFecha']?></label>
                            <?php echo '<input type="text" class="form-control" id="fecha" name="fecha" placeholder="'.$literales['ejemploFecha'].'">'; 
                            ?>
                        </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input id="enviar" name="enviar" class="btn btn-primary" value="Enviar" type="submit">
                            <a class="btn btn-default" href="ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN";">&laquo; <?php echo $literales['cancelar'];?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>