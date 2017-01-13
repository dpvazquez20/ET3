<style>
    a{
        padding: 10px 10px 10px 10px;
    }
</style>
<script type="text/javascript" src="../bootstrap/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../bootstrap/js/jquery-latest.js"></script>
<?php
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/PERFIL_Model.php');
include_once('../modelos/ALBARAN_Model.php');



if(!isset($_SESSION)){
    session_start();
}


class Albaran_showAll{

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
        <title> <?php echo $literales['mostrarAlbaranes'] ?></title>
            <div>
                <div class="col-sm-4">
                    <?php $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
               
                    $allowADD=false;
                    while($row=mysqli_fetch_assoc($listaControladores)){
                        if($row['controlador']==$_GET['ctr']){
                            if($row['accion']=='ADD'){
                                echo "<a href='../controladores/".$row['controlador']."_Controller.php?id=".$row['accion'].$row['controlador']."'><button class='btn  btn-primary'>".$literales['ADD']." ".$row['controlador']."</button></a></br></br>";
                            }
                        }
                    }

                    ?>

                </div>


                <div class="col-sm-4">
                
                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARALBARAN"/>
                    <input type="hidden" name="ctr" value="ALBARAN"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder=<?php echo $literales['buscarPorId'] ?> type="text" id="idBuscar" name="idBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Buscar</button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>

                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARALBARAN"/>
                    <input type="hidden" name="ctr" value="ALBARAN"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder=<?php echo $literales['buscarPorFecha'] ?> type="text" id="fechaBuscar" name="fechaBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Buscar</button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>
                </div>

                
                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th><?php echo $literales['idAlbaran'] ?></th>
                        <th><?php echo $literales['fecha'] ?></th>
                      
                        <th colspan="3"  ><?php echo $literales['accion'] ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                     if (isset($_GET['idBuscar'])) {
                        $resul = Albaran_Model::getAlbaranesById($_GET['idBuscar']);
                    }else {
                        if(isset($_GET['fechaBuscar'])){
                            $resul = Albaran_Model::getAlbaranesByFecha($_GET['fechaBuscar']);
                        }else{
                            $resul= Albaran_Model::listar();
                        }
                    }

                    //Albaranes a ver
                    //$resul= Albaran_Model::listar();
                    
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['id'] . "</td> <td>" . $row['fecha'] . "</td> <td>";
                        $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
                        while($accion = mysqli_fetch_assoc($listaControladores)){
                            if($accion['controlador']==$_GET['ctr']) {
                                if ($accion['accion'] != "ADD") {
                                    $estilo = 'btn btn-default';
                                    $nombreBoton =$accion['accion'];

                                    if ($accion['accion'] == "SHOW") {
                                        $estilo = 'btn btn-success';
                                        $nombreBoton= $literales['SHOW'];
                                    }

                                    if ($accion['accion'] == "EDIT") {
                                        $estilo = 'btn btn-warning';
                                        $nombreBoton= $literales['EDIT'];
                                    }

                                    if ($accion['accion'] == "DELETE") {
                                        $estilo = 'btn btn-danger';
                                        $nombreBoton= $literales['DELETE'];
                                    }
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&idAlbaran=" . $row['id'] . "'><button class='" . $estilo . "'>" .$nombreBoton. "</button></a>";
                                }
                            }
                        }
                        echo"</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>

                </table>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>