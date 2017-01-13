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
require_once ('../modelos/STOCK_MATERIAL_Model.php');

class Stock_material_showAll{

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
                
                <!-- Buscador por id -->
                <div class="col-sm-4">

                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARSTOCK_MATERIAL"/>
                        <input type="hidden" name="ctr" value="STOCK_MATERIAL"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder=<?php echo $literales['stockId'] ?> type="text" pattern="[0123456789]*" id="idBuscar" name="idBuscar"style="width: 200px" class=" form-control"> </input>
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><?php echo $literales['buscarStock'] ?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                        
                <!-- Buscador por material-->
                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARSTOCK_MATERIAL"/>
                        <input type="hidden" name="ctr" value="STOCK_MATERIAL"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder="<?php echo $literales['stockId_material'] ?>" type="text" id="materialBuscar" name="materialBuscar"style="width: 200px" class=" form-control"> </input>
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><?php echo $literales['buscarStock'] ?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Buscador por albaran-->
                <div class="col-sm-4">
                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARSTOCK_MATERIAL"/>
                        <input type="hidden" name="ctr" value="STOCK_MATERIAL"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder="<?php echo $literales['stockId_albaran'] ?>" type="text" pattern="[0123456789]*" id="albaranBuscar" name="albaranBuscar"style="width: 200px" class=" form-control"> </input>
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><?php echo $literales['buscarStock'] ?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                
                <!-- Buscador por producto-->
                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARSTOCK_MATERIAL"/>
                        <input type="hidden" name="ctr" value="STOCK_MATERIAL"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <input placeholder="<?php echo $literales['stockId_producto'] ?>" type="text" id="productoBuscar" name="productoBuscar"style="width: 200px" class=" form-control"> </input>
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><?php echo $literales['buscarStock'] ?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th> <?php echo $literales['stockId'] ?> </th>
                        <th> <?php echo $literales['stockId_material'] ?> </th>
                        <th> <?php echo $literales['stockId_albaran'] ?> </th>
                        <th> <?php echo $literales['stockId_producto'] ?> </th>
                        <th colspan="3"> <?php echo $literales['stockAccion'] ?> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    if(isset($_GET['idBuscar'])) {
                        $resul=Stock_material_modelo::getStockId($_GET['idBuscar']);
                    }else{
                        if(isset($_GET['materialBuscar'])){
                            $resul=Stock_material_modelo::getStockMaterial($_GET['materialBuscar']);

                        }else {
                            if(isset($_GET['albaranBuscar'])){
                                $resul=Stock_material_modelo::getStockAlbaran($_GET['albaranBuscar']);

                            }else {
                                if(isset($_GET['productoBuscar'])){
                                    $resul=Stock_material_modelo::getStockProducto($_GET['productoBuscar']);
                                }else {
                                    $resul= Stock_material_modelo::listarStock();
                                }
                            }
                        }
                    }
                    
                    while($row = mysqli_fetch_assoc($resul)) {
                        
                        $prod = $row['id_producto'];
                        if($prod == null) {
                            $prod ="(No asignado)";
                        }else{
                            $prod=utf8_decode(Stock_material_modelo::getProducto($row['id_producto']));
                        }
                        $mat= utf8_decode(Stock_material_modelo::getMaterial($row['id_material']));
                        
                        echo "<tr><td>" . $row['id'] . "</td> <td>" . $mat .  "</td> <td>" . $row['id_albaran'] . "</td> <td>" . $prod . "</td> <td>";
                        $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
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