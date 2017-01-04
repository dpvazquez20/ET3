<style>
    a{
        padding: 10px 10px 10px 10px;
    }
</style>
<script type="text/javascript" src="../bootstrap/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../bootstrap/js/jquery-latest.js"></script>
<?php

require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/PEDIDO_Model.php');
require_once ('../modelos/PROVEEDOR_Model.php');
require_once ('../modelos/USUARIO_Model.php');

if(!isset($_SESSION)){
    session_start();
}


class Pedido_showAll{

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
                        <?php $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);
                        $allowADD=false;
                        while($row=mysqli_fetch_assoc($listaControladores)){
                            if($row['controlador']==$_GET['ctr']){
                                if($row['accion']=='ADD'){
                                    echo "<a href='../controladores/".$row['controlador']."_Controller.php?id=".$row['accion'].$row['controlador']."'><button class='btn  btn-primary'>".$row['accion']." ".$row['controlador']."</button></a></br></br>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Proveedor</th>
                        <th>NIF Proveedor</th>
                        <th>DNI Usuario</th>
                        <th>Fecha</th>
                        <th colspan="3"  >Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $resul= Pedido_modelo::listarPedidos();
                    while($row = mysqli_fetch_assoc($resul)) {

                        $resulP = Proveedor_modelo::getProveedor($row['id_proveedor']);
                        $rowP = mysqli_fetch_assoc($resulP);
                        $resulU = Usuario_modelo::getUsuario($row['id_usuario']);
                        $rowU = mysqli_fetch_assoc($resulU);

                        echo "<tr><td>" . $row['id'] . "</td> <td>" . $rowP['nombre'] . "</td> <td>"  . $rowP['nif'] . "</td> <td>" . $rowU['DNI'] . "</td> <td>" . $row['fecha'] . "</td> <td>";
                        $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);

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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador']  . "&ctr=" . $accion['controlador'] . "&idPedido=" . $row['id'] . "'><button class='" . $estilo . "'>" . $nombreBoton . "</button></a>";
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