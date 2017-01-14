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

    //Vista que devuelve una lista completa de todos
    //los pedidos, con su id, el nombre y nif del proveedor,
    //el dni usuario, y la fecha en que se hizo

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <script>
                    $( function() {
                        $( "#fechaBuscar" ).datepicker();
                    } );
                </script>

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
                <div class="col-sm-4">
                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARPEDIDO"/>
                    <input type="hidden" name="ctr" value="PEDIDO"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder="<?php echo $literales['id pedido a buscar']?>" type="text" id="idBuscar" name="idBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><?php echo $literales['buscar']?></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>
                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARPEDIDO"/>
                    <input type="hidden" name="ctr" value="PEDIDO"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder="<?php echo $literales['nombre proveedor a buscar']?>" type="text" id="nombreBuscar" name="nombreBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><?php echo $literales['buscar']?></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-sm-4">
                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARPEDIDO"/>
                    <input type="hidden" name="ctr" value="PEDIDO"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder="<?php echo $literales['nif proveedor a buscar']?>" type="text" id="nifBuscar" name="nifBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><?php echo $literales['buscar']?></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>
                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARPEDIDO"/>
                    <input type="hidden" name="ctr" value="PEDIDO"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder="<?php echo $literales['dni usuario a buscar']?>" type="text" id="dniBuscar" name="dniBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><?php echo $literales['buscar']?></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>

                <form role="form" method="get">
                    <input type="hidden" name="id" value="BUSCARPEDIDO"/>
                    <input type="hidden" name="ctr" value="PEDIDO"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder="<?php echo $literales['fecha a buscar']?>" type="text" id="fechaBuscar" name="fechaBuscar"
                                           style="width: 200px" class=" form-control"> </input>
                                </div>
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><?php echo $literales['buscar']?></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                </form>
                </div>

                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th><?php echo $literales['id pedido']?></th>
                        <th><?php echo $literales['nombre proveedor']?></th>
                        <th><?php echo $literales['nif proveedor']?></th>
                        <th><?php echo $literales['dni usuario']?></th>
                        <th><?php echo $literales['fecha']?></th>
                        <th colspan="3"  ><?php echo $literales['accion']?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_GET['idBuscar'])) {
                        $resul = Pedido_modelo::getIDPedido($_GET['idBuscar']);
                    }else {
                        if(isset($_GET['nombreBuscar'])){
                            $resul = Pedido_modelo::getNombreProveedorPedido($_GET['nombreBuscar']);
                        }else{
                            if(isset($_GET['nifBuscar'])){
                                $resul = Pedido_modelo::getNIFProveedorPedido($_GET['nifBuscar']);
                        }
                            else{
                                if (isset($_GET['dniBuscar'])){
                                    $resul = Pedido_modelo::getDNIUsuarioPedido($_GET['dniBuscar']);
                        }
                                else
                                    if(isset($_GET['fechaBuscar'])) {
                                        $resul = Pedido_modelo::getFechaPedido($_GET['fechaBuscar']);
                                    }
                                    else{
                                        $resul = Pedido_modelo::listarPedidos();
                    }}}}
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