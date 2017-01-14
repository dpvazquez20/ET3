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
require_once ('../modelos/PRODUCTO_Model.php');
require_once ('../modelos/PRODUCTO.php');

class Producto_showAll{

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





                <div class="col-sm-4">
                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARPRODUCTO"/>
                        <input type="hidden" name="ctr" value="PRODUCTO"/>
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
                        <input type="hidden" name="ctr" value="PRODUCTO"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder="Descipcion a buscar" type="text" id="desBuscar" name="desBuscar"
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
                        <th><?php echo $literales['nombreProductoSA'] ?></th>
                        <th><?php echo $literales['descripcionProductoSA'] ?></th>
                        <th colspan="3"  ><?php echo $literales['accionProductoSA']?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php


                    if (isset($_GET['nombreBuscar'])) {
                        $resul = Producto_modelo::getNombreProducto($_GET['nombreBuscar']);
                    }
                    else {
                        if (isset($_GET['desBuscar'])) {

                            $resul = Producto_modelo::getDEsProducto($_GET['desBuscar']);

                        } else {
                            $resul= Producto_modelo::listarProducto();
                        }
                    }



                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['nombre'] . "</td> <td>".$row['descripcion']."</td><td>";
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&idProducto=" . $row['id_producto'] . "'><button class='" . $estilo . "'>" .$nombreBoton . "</button></a>";
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
