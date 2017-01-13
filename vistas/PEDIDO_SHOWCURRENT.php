<?php

if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/PEDIDO_Model.php');
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/LINEA_PEDIDO_Model.php');

class Pedido_show{

    function __construct(){
        $this->render();
    }

    //vista que devuelve los datos del pedido y del proveedor
    //a los que va dirigido, además de todas las lineas de pedido
    //asociado a ese pedido

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['mostrar pedido']; ?></title>

                <?php
                $resul = Pedido_modelo::getPedido($_GET['idPedido']);
                $row= mysqli_fetch_assoc($resul);

                $resulP = Proveedor_modelo::getProveedor($row['id_proveedor']);
                $rowP = mysqli_fetch_assoc($resulP);
                $resulU = Usuario_modelo::getUsuarioSinBorrar($row['id_usuario']);
                $rowU = mysqli_fetch_assoc($resulU);
                ?>
                <div class="alert alert-success"><?php echo $literales['pedidoSHOW']?></div>
                <form>

                    <div class="form-group">
                        <label for="id_pedido"><?php echo $literales['id pedido']?></label>
                        <input type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                               value="<?php echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="NombrePE"><?php echo $literales['nombre proveedor']?></label>
                        <input type="text" class="form-control" id="NombrePE" name="NombrePE" readonly="readonly"
                               value="<?php echo $rowP['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="NIFE">NIF </label>
                        <input type="text" class="form-control" id="NIFE" name="NIFE" readonly="readonly"
                               value="<?php echo $rowP['nif']?>">
                    </div>
                    <div class="form-group">
                        <label for="dirE"><?php echo $literales['direccion']?></label>
                        <input type="text" class="form-control" id="dirE" name="dirE" readonly="readonly"
                               value="<?php echo $rowP['direccion']?>">
                    </div>
                    <div class="form-group">
                        <label for="postalE"><?php echo $literales['codigo postal']?></label>
                        <input type="text" class="form-control" id="postalE" name="postalE" readonly="readonly"
                               value="<?php echo $rowP['codigo_postal']?>">
                    </div>
                    <div class="form-group">
                        <label for="ciudadE"><?php echo $literales['ciudad']?></label>
                        <input type="text" class="form-control" id="ciudadE" name="ciudadE" readonly="readonly"
                               value="<?php echo $rowP['ciudad']?>">
                    </div>
                    <div class="form-group">
                        <label for="provinciaE"><?php echo $literales['provincia']?></label>
                        <input type="text" class="form-control" id="provinciaE" name="provinciaE" readonly="readonly"
                               value="<?php echo $rowP['provincia']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="DNIE"><?php echo $literales['dni usuario']?></label>
                        <input type="text" class="form-control" id="DNIE" name="DNIE" readonly="readonly"
                               value="<?php echo $rowU['DNI']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="fecha"><?php echo $literales['fecha']?></label>
                        <input type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                               value="<?php echo $row['fecha']?>">
                    </div>

                </form>
                    <div>
                        <div class="col-sm-4">
                            <?php $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);
                            $allowADD=false;
                            while($row2=mysqli_fetch_assoc($listaControladores)){
                                if($row2['controlador']==$_GET['ctr']){
                                    if($row2['accion']=='ADD'){
                                        echo "<a href='../controladores/".$row2['controlador']."_Controller.php?id=".$row2['accion']."LINEA".$row2['controlador']."&idPedido=".$_GET['idPedido']."'><button class='btn  btn-primary'>".$row2['accion']." LINEA ".$row2['controlador']."</button></a></br></br>";
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th><?php echo $literales['id linea']?></th>
                        <th><?php echo $literales['material']?></th>
                        <th><?php echo $literales['cantidad']?></th>
                        <th><?php echo $literales['precio']?></th>
                        <th colspan="3"  >Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $resul2= Linea_Pedido_modelo::listarLineasPedido($_GET['idPedido']);
                    while($row3 = mysqli_fetch_assoc($resul2)) {

                        $resulM = Material_modelo::getMaterial($row3['id_material']);
                        $rowM = mysqli_fetch_assoc($resulM);

                        echo "<tr> <td>" . $row3['id'] . "</td> <td>" . $rowM['nombre'] . "</td> <td>" . $row3['cantidad'] . "</td> <td>" . $row3['precio'] . "</td> <td>";
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . "LINEA" . $accion['controlador'] . "&idPedido=" . $row3['id_pedido'] . "&idLineaPedido=" . $row3['id'] . "'><button class='" . $estilo . "'>" . $nombreBoton . "</button></a>";
                                }
                            }
                        }
                        echo"</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>

                    <div class="form-group">
                        <a class="btn btn-default"href="PEDIDO_Controller.php?id=SHOWALLPEDIDO&ctr=PEDIDO"">&laquo; Volver atrás</a>
                    </div>
            </div>
        </div>




        <?php include_once ('pieDePagina.php');

    }
}
?>