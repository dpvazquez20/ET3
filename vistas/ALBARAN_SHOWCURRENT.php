<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ALBARAN_Model.php');

class Albaran_show{

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
            <title> <?php echo $literales['mostrarAlbaran'] ?></title>
                <?php
                $resul = Albaran_model::getAlbaran($_GET['idAlbaran']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['albaranSHOWCURRENT'] ?></div>

                <form role="form" action="ALBARAN_Controller.php?id=SHOWALBARAN&ctr=ALBARAN" method="POST">
                    <div class="form-group">
                      

                        <label for="controlador"><?php echo $literales['idAlbaran'] ?></label>
                        <input  type="text" class="form-control" id="id_albaran" name="id_albaran" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="accionB"><?php echo $literales['idPedido'] ?></label>
                        <input  type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                                value="<?php  echo $row['id_pedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB"><?php echo $literales['fecha'] ?></label>
                        <input  type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                                value="<?php  echo $row['fecha']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <a class="btn btn-default" href="ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN";"><?php echo $literales['volver'];?></a>
                    </div>

                </form>


                <div>
                        <div class="col-sm-4">
                            <?php $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);
                            $allowADD=false;
                            while($row2=mysqli_fetch_assoc($listaControladores)){
                                if($row2['controlador']=="ALBARAN"){
                                    if($row2['accion']=='ADD'){
                                        echo "<a href='../controladores/".$row2['controlador']."_Controller.php?id=".$row2['accion']."LINEA".$row2['controlador']."&idAlbaran=".$_GET['idAlbaran']."'><button class='btn  btn-primary'>".$row2['accion']." LINEA ".$row2['controlador']."</button></a></br></br>";
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th><?php echo $literales['idLinea'] ?></th>
                        <th><?php echo $literales['idMaterial'] ?></th>
                        <th><?php echo $literales['nombreMaterial'] ?></th>
                        <th><?php echo $literales['cantidad'] ?></th>
                        <th colspan="3"  ><?php echo $literales['accion'] ?></th>
                      
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    //Lineas albaran
                    $resul= Albaran_Model::getLineasAlbaran($_GET['idAlbaran']);
                    //$resul= Albaran_Model::listar();
                    //var_dump($resul);
                    $controladorAct = "ALBARAN";
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['id_linea'] . "</td> <td>" . $row['id_material'] . "</td> <td>". $row['material_nombre'] . "</td> <td>". $row['cantidad'] . "</td> <td>";
                       
                       $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);

                        while($accion = mysqli_fetch_assoc($listaControladores)){
                            if($accion['controlador']=="ALBARAN") {
                                if ($accion['accion'] != "ADD") {
                                    $estilo = 'btn btn-default';
                                    $nombreBoton =$accion['accion'];
                                    if ($accion['accion'] == "EDIT") {
                                        $estilo = 'btn btn-warning';
                                        $nombreBoton= $literales['EDIT'];
                                    }

                                    if ($accion['accion'] == "SHOW") {
                                        $estilo = 'btn btn-success';
                                        $nombreBoton= $literales['SHOW'];
                                    }

                                    if ($accion['accion'] == "DELETE") {
                                        $estilo = 'btn btn-danger';
                                        $nombreBoton= $literales['DELETE'];
                                    }
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . "LINEA" . $accion['controlador'] . "&idAlbaran=" . $row['id_albaran'] . "&idLineaAlbaran=" . $row['id_linea'] . "'><button class='" . $estilo . "'>" . $nombreBoton . "</button></a>";
                                }
                            }
                        }

                        
                        echo"</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>