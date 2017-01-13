<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/FACTURA_Model.php');

class Factura_show{

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
            <title><?php echo $literales['mostrarFactura'] ?></title>
                <?php
                $resul = Factura_model::getFactura($_GET['idFactura']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['facturaSHOWCURRENT'] ?></div>

                <form role="form" action="FACTURA_Controller.php?id=SHOWFACTURA&ctr=FACTURA" method="POST">
                    <div class="form-group">
                      

                        <label for="controlador"><?php echo $literales['idFactura'] ?></label>
                        <input  type="text" class="form-control" id="id_factura" name="id_factura" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="accionB"><?php echo $literales['proveedor'] ?></label>
                        <input  type="text" class="form-control" id="id_proveedor" name="id_proveedor" readonly="readonly"
                                value="<?php  echo $row['id_proveedor']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB"><?php echo $literales['nif'] ?></label>
                        <input  type="text" class="form-control" id="NIF" name="NIF" readonly="readonly"
                                value="<?php  echo $row['NIF']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB"><?php echo $literales['fecha'] ?></label>
                        <input  type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                                value="<?php  echo $row['fecha']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <a class="btn btn-default" href="FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA";"><?php echo $literales['volver'];?></a>
                    </div>

                </form>

                <div>
                        <div class="col-sm-4">
                            <?php $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);
                            $allowADD=false;
                            while($row2=mysqli_fetch_assoc($listaControladores)){
                                if($row2['controlador']=="FACTURA"){
                                    if($row2['accion']=='ADD'){
                                        echo "<a href='../controladores/".$row2['controlador']."_Controller.php?id=".$row2['accion']."LINEA".$row2['controlador']."&idFactura=".$_GET['idFactura']."'><button class='btn  btn-primary'>".$row2['accion']." LINEA ".$row2['controlador']."</button></a></br></br>";
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
                        <th><?php echo $literales['idAlbaran'] ?></th>
                        <th colspan="3"  ><?php echo $literales['accion'] ?></th>
                        
                      
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    //Lineas albaran
                    $resul= Factura_Model::getLineasFactura($_GET['idFactura']);
                    //$resul= Factura_Model::listar();
                    //var_dump($resul);
                    $controladorAct = "FACTURA";
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['id_linea'] . "</td> <td>" . $row['id_albaran'] . "</td> <td>";


                        $listaControladores = Controlador_modelo::controladores($_SESSION['perfil']);

                        while($accion = mysqli_fetch_assoc($listaControladores)){
                            if($accion['controlador']=="FACTURA") {
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . "LINEA" . $accion['controlador'] . "&idFactura=" . $row['id_factura'] . "&idLineaFactura=" . $row['id_linea'] . "'><button class='" . $estilo . "'>" . $nombreBoton . "</button></a>";
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