<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
require_once('../modelos/ELABORACION_Model.php');
require_once('../modelos/LINEA_ELABORACION_Model.php');
require_once ('../modelos/PERFIL_Model.php');
require_once ('../modelos/CONTROLADOR_Model.php');


class Elaboracion_show{

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
                <?php
                $resul= Elaboracion_modelo::getElaboracionID($_GET['idElaboracion']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-info"><?php echo $literales['elaboracionSHOW'] ?> </div>

                <form role="form" action="ELABORACION_Controller.php?id=SHOWELABORACION&ctr=ELABORACION" method="POST">
                    <div class="form-group">
                        <label for="nombreB">Nombre</label>
                        <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                                value="<?php  echo $row['nombre_elaboracion']?>">
                    </div>
                </form>

                <div>
                    <div class="col-sm-4">
                        <?php $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);
                        $allowADD=false;
                        while($row2=mysqli_fetch_assoc($listaControladores)){
                            if($row2['controlador']==$_GET['ctr']){
                                if($row2['accion']=='ADD'){
                                    echo "<a href='../controladores/".$row2['controlador']."_Controller.php?id=".$row2['accion']."LINEA".$row2['controlador']."&idElaboracion=".$_GET['idElaboracion']."'><button class='btn  btn-primary'>".$row2['accion']." LINEA ".$row2['controlador']."</button></a></br></br>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Nombre del Material</th>
                        <th>Cantidad</th>
                        <th colspan="3"  >   Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $resul2= Linea_elaboracion_modelo::listarLineasElaboracion($_GET['idElaboracion']);

                    while($row3 = mysqli_fetch_assoc($resul2)) {

                        $resulM = Material_modelo::getMaterial($row3['id_material']);
                        $rowM = mysqli_fetch_assoc($resulM);

                        echo "<tr><td>" . $rowM['nombre'] . "</td> <td>" . $row3['cantidad'] . "</td> <td>";
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . "LINEA" . $accion['controlador'] . "&idElaboracion=" . $row3['id_elaboracion'] . "&idLineaElaboracion=" . $row3['id_linea_elaboracion'] . "'><button class='" . $estilo . "'>" . $nombreBoton . "</button></a>";
                                }
                            }
                        }
                        echo"</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>

                <a class="btn btn-default" href="ELABORACION_Controller.php?id=SHOWALLELABORACION&ctr=ELABORACION";">&laquo; <?php echo $literales['cancelar'];?></a
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>