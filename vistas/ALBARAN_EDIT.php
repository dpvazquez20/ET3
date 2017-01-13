<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ALBARAN_Model.php');

class Albaran_edit{

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
            <title> <?php echo $literales['editarAlbaran'] ?></title>
             <script>
                    $( function() {
                        $( "#fecha" ).datepicker({dateFormat: "yy-mm-dd"});
                    } );
            </script>
                <?php
                $resul = Albaran_model::getAlbaran($_GET['idAlbaran']);
                $albaran = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['albaranSHOW'] ?></div>

                 <form role="form" action="ALBARAN_Controller.php?id=EDITALBARAN&ctr=ALBARAN" method="POST">

                  

                               <label for="idAlbaran"><?php echo $literales['idAlbaran'] ?></label>
                        <input  type="text" class="form-control" id="id_albaran" name="id_albaran" readonly="readonly"
                                value="<?php  echo $albaran['id']?>">

                    <!-- Seleccion del pedido-->
                    <div class="form-group">
                        <label for="pedido"><?php  echo $literales['idPedido']?></label>
                        <select id="id_pedido" name="id_pedido"style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PEDIDO
                            $pedidos= Albaran_Model::listarPedidos();
                            while($row = mysqli_fetch_assoc($pedidos)){
                                $selected ="";
                                if($row['id']==$albaran['id_pedido']){
                                    $selected ='selected="selected"';
                                }
                                
                                echo "<option ".$selected." value='".$row['id']."' >".$row['id']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                <!-- Seleccion de la fecha-->
                    <div class="form-group">
                            <label for="fecha"><?php  echo $literales['inputFecha']?></label>
                            <input type="date" class="form-control" id="fecha" name="fecha" <?php echo 'value="'.$albaran['fecha'].'"';?>>
                        </div>
                    <div class="form-group">
                            <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                            <a class="btn btn-default" href="../controladores/ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN";">&laquo; Volver atrás</a>
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