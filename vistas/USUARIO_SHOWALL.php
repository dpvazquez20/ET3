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
require_once ('../modelos/PERFIL_Model.php');
require_once ('../modelos/USUARIO_Model.php');


class Usuario_showAll{

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
                    <!-- Buscador por perfil -->
                    <div class="col-sm-4">
                        <form role="form" method="get">
                            <input type="hidden" name="id" value="BUSCARUSUARIO"/>
                            <input type="hidden" name="ctr" value="USUARIO"/>
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
                        <!-- Buscador por nombre-->
                        <form role="form" method="get">
                            <input type="hidden" name="id" value="BUSCARUSUARIO"/>
                            <input type="hidden" name="ctr" value="USUARIO"/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <input placeholder="Nombre a buscar" type="text" id="nombreBuscar" name="nombreBuscar"style="width: 200px" class=" form-control"> </input>
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Buscar</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <form role="form" method="get">
                            <input type="hidden" name="id" value="BUSCARUSUARIO"/>
                            <input type="hidden" name="ctr" value="USUARIO"/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <input placeholder="Apellido a buscar" type="text" id="apellidoBuscar" name="apellidoBuscar"style="width: 200px" class=" form-control"> </input>
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Buscar</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form role="form" method="get">
                                <input type="hidden" name="id" value="BUSCARUSUARIO"/>
                                <input type="hidden" name="ctr" value="USUARIO"/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <div class="form-group">
                                                <input placeholder="DNI a buscar" type="text" id="dniBuscar" name="dniBuscar"style="width: 200px" class=" form-control"> </input>
                                            </div>
                                            <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Buscar</button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                        </form>

                    </div>


                </div>
                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Perfil</th>
                        <th colspan="3">Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['perfilBuscar'])) {
                        $resul=Usuario_modelo::getUsuarioPerfil($_GET['perfilBuscar']);
                    }else{
                        if(isset($_GET['nombreBuscar'])){
                            $resul=Usuario_modelo::getUsuarioNombre($_GET['nombreBuscar']);

                        }else {
                            if(isset($_GET['apellidoBuscar'])){
                                $resul=Usuario_modelo::getUsuarioApellido($_GET['apellidoBuscar']);

                            }else {
                                if(isset($_GET['dniBuscar'])){
                                    $resul=Usuario_modelo::getUsuarioDNI($_GET['dniBuscar']);
                                }else {
                                    $resul = Usuario_modelo::listar();
                                }
                            }
                        }
                    }
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['nombre'] . "</td> <td>" . $row['apellido'] . "</td> <td>" . $row['DNI'] . "</td> <td>" . $row['perfil'] . "</td> <td>";
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&idUser=" . $row['id_usuario'] . "'><button class='" . $estilo . "'>" . $nombreBoton . "</button></a>";
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