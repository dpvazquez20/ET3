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
                                    echo "<a href='../controladores/".$row['controlador']."_Controller.php?id=".$row['accion'].$row['controlador']."'><button class='btn  btn-primary'>".$row['accion']." ".$row['controlador']."</button></a></br></br>";
                                }
                            }
                        }
                ?>
                    </div>
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
                    </div>
                </div>
                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Password</th>
                        <th>Perfil</th>
                        <th colspan="3"  >Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['perfilBuscar'])) {
                        $resul=Usuario_modelo::getUsuarioPerfil($_GET['perfilBuscar']);
                    }else{
                          $resul= Usuario_modelo::listar();
                    }
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['nombre'] . "</td> <td>" . $row['apellido'] . "</td> <td>" . $row['DNI'] . "</td> <td>" . $row['password'] . "</td> <td>" . $row['perfil'] . "</td> <td>";
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
                                    echo "<a href='../controladores/" . $accion['controlador'] . "_Controller.php?id=" . $accion['accion'] . $accion['controlador'] . "&idUser=" . $row['id_usuario'] . "'><button class='" . $estilo . "'>" . $accion['accion'] . "</button></a>";
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