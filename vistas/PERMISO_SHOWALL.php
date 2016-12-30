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
include_once('../modelos/PERMISO_Model.php');



if(!isset($_SESSION)){
    session_start();
}


class Permiso_showAll{

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
                                echo "<a href='../controladores/".$row['controlador']."_Controller.php?id=".$row['accion'].$row['controlador']."'><button class='btn  btn-primary'>".$row['accion']." ".$row['controlador']."</button></a></br></br>";
                            }
                        }
                    }

                    ?>

                </div>
                <div class="col-sm-4">
                    <form role="form" method="get">
                        <input type="hidden" name="id" value="BUSCARUSUARIO"/>
                        <input type="hidden" name="ctr" value="PERMISO"/>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <select id="perfilBuscar" name="perfilBuscar"style="width: 200px" class=" form-control">
                                        <?php
                                        $perfiles= Perfil_modelo::listarPerfiles();
                                        echo"<option selected value=''> </option>";
                                        while($row = mysqli_fetch_assoc($perfiles)){
                                            echo "<option value='".$row['nombre']."' >".$row['nombre']."</option>";
                                        }
                                        ?>
                                    </select>
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
                        <th>id_Permiso</th>
                        <th>Controlador</th>
                        <th>Accion</th>
                        <th>Perfil</th>
                        <th colspan="3"  >Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['perfilBuscar'])) {
                        $resul= Permiso_modelo::getPermiso($_GET['idPermiso']);
                    }else{
                        $resul= Permiso_modelo::listarPermisos();
                    }
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['id_permiso'] . "</td> <td>" . $row['controlador'] . "</td> <td>" . $row['accion'] . "</td> <td>" . $row['perfil'] . "</td> <td>";
                        $listaControladores = Controlador_modelo::controladores(($_SESSION['perfil']));
                        while($accion = mysqli_fetch_assoc($listaControladores)){
                            if($accion['controlador']==$_GET['ctr']) {
                                if ($accion['accion'] != "ADD") {
                                    $estilo = 'btn btn-default';
                                    if ($accion['accion'] == "EDIT") {
                                        $estilo = 'btn btn-warning';
                                    }

                                    if ($accion['accion'] == "SHOW") {
                                        $estilo = 'btn btn-success';
                                    }

                                    if ($accion['accion'] == "DELETE") {
                                        $estilo = 'btn btn-danger';
                                    }
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&idPermiso=" . $row['id_permiso'] . "'><button class='" . $estilo . "'>" . $accion['accion'] . "</button></a>";
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