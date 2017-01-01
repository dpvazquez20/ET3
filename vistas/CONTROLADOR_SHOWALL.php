<style>
    a{
        padding: 10px 10px 10px 10px;
    }
</style>
<script type="text/javascript" src="../bootstrap/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../bootstrap/js/jquery-latest.js"></script>
<?php

if(!isset($_SESSION)){
    session_start();
}
require_once ('../modelos/CONTROLADOR_Model.php');


class Controlador_showAll{

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
                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th colspan="3"  >Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $resul=Controlador_modelo::listarControladores();
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['nombre'] . "</td> <td>";
                        $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
                        while($accion = mysqli_fetch_assoc($listaControladores)){
                            if($accion['controlador']==$_GET['ctr']) {
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&nombreControlador=" . $row['nombre'] . "'><button class='" . $estilo . "'>" .$nombreBoton . "</button></a>";
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