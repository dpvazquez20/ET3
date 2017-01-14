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
require_once ('../modelos/STOCK_PRODUCTO_Model.php');
require_once ('../modelos/MATERIAL_Model.php');
require_once ('../modelos/PRODUCTO_Model.php');

class Stock_producto_showAll{

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

            <script>
                $( function() {
                    $( "#fecha" ).datepicker();
                } );
            </script>


            <title><?php echo $literales['listaStock']; ?></title>
            <div>

                <div class="col-sm-4">
                    <?php $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
                    $allowADD=false;
                    while($row=mysqli_fetch_assoc($listaControladores)){
                        if($row['controlador']==$_GET['ctr']){
                            if($row['accion']=='ADD'){
                                echo "<a href='../controladores/".$row['controlador']."_Controller.php?id=".$row['accion'].$row['controlador']."'><button class='btn  btn-primary'>". $literales['stADD'] ."</button></a></br></br>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>

                <div class="col-sm-4">
                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARPRODUCTO"/>
                        <input type="hidden" name="ctr" value="STOCK_PRODUCTO"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder="Nombre a buscar" type="text" id="nombreBuscar" name="nombreBuscar"
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
                        <input type="hidden" name="id" value="BUSCARPRODUCTO"/>
                        <input type="hidden" name="ctr" value="STOCK_PRODUCTO"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder="Coste a buscar" type="text" id="costeBuscar" name="costeBuscar"
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
                    <input type="hidden" name="id" value="BUSCARPRODUCTO"/>
                    <input type="hidden" name="ctr" value="STOCK_PRODUCTO"/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="form-group">
                                    <input placeholder="Fecha a buscar" type="text" id="fecha" name="fecha"
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
                        <th> <?php echo $literales['nombre'] ?> </th>
                        <th> <?php echo $literales['stockcoste'] ?> </th>
                        <th> <?php echo $literales['fecha'] ?> </th>
                        <th colspan="3"> <?php echo $literales['Accion'] ?> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                        if (isset($_GET['nombreBuscar'])) {
                            $resul = Stock_producto_modelo::getNombreProducto($_GET['nombreBuscar']);
                        }
                        else {
                            if (isset($_GET['costeBuscar'])) {

                                $resul = Stock_producto_modelo::getPorCoste($_GET['costeBuscar']);

                            } else {
                                if (isset($_GET['fecha'])){

                                    $resul = Stock_producto_modelo::getPorFecha($_GET['fecha']);

                                }else{

                                    $resul= Stock_producto_modelo::listarStock();

                                }
                            }
                        }

                        while($row = mysqli_fetch_assoc($resul)){
                            $resultadoMaterial= Producto_modelo::getProducto($row['id_producto']);
                            $rowMaterial = mysqli_fetch_assoc($resultadoMaterial);

                            echo "<tr><td>" . $rowMaterial['nombre'] . "</td> <td>" . $row['coste'] . "</td><td>" . $row['fecha'] . "</td><td>";                        $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
                            while($accion = mysqli_fetch_assoc($listaControladores)){
                                if($accion['controlador']==$_GET['ctr']) {
                                    if ($accion['accion'] != "ADD") {
                                        $estilo = 'btn btn-default';
                                        $nombreBoton =$literales['ADD'];
                                        if ($accion['accion'] == "EDIT") {
                                            $estilo = 'btn btn-warning';
                                            $nombreBoton =$literales['EDIT'];
                                        }

                                        if ($accion['accion'] == "SHOW") {
                                            $estilo = 'btn btn-success';
                                            $nombreBoton =$literales['SHOW'];
                                        }

                                        if ($accion['accion'] == "DELETE") {
                                            $estilo = 'btn btn-danger';
                                            $nombreBoton =$literales['DELETE'];
                                        }
                                        echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&idStock=" . $row['id'] . "'><button class='" . $estilo . "'>" .$nombreBoton . "</button></a>";                               }
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