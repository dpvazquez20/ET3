<?php
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/ACCION_Model.php');
require_once ('../modelos/PERFIL_Model.php');
include_once('../modelos/PERMISO_Model.php');

if(!isset($_SESSION)){
    session_start();
}

class Permiso_edit{

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
                $resul= Permiso_modelo::getPermiso($_GET['idPermiso']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-warning"><?php echo $literales['permisoMODIFY']?></div>



                <form role="form" action="PERMISO_Controller.php?id=EDITPERMISO&ctr=PERMISO" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_permiso" name="id_permiso"
                               value="<?php echo $row['id_permiso']?>">

                        <div class="form-group">
                            <label for="controladorM"><?php  echo $literales['seleccion controlador']?></label>
                            <select id="controladorM" name="controladorM"style="width: 200px" class=" form-control">
                                <?php
                                $perfiles= Controlador_modelo::listarControladores();
                                while($row = mysqli_fetch_assoc($perfiles)){
                                    echo "<option value='".$row['nombre']."' >".$row['nombre']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Seleccion de la accion-->
                        <div class="form-group">
                            <label for="accionM"><?php  echo $literales['seleccion accion']?></label>
                            <select id="accionM" name="accionM"style="width: 200px" class=" form-control">
                                <?php
                                $perfiles= Accion_modelo::listarAcciones();
                                while($row = mysqli_fetch_assoc($perfiles)){
                                    echo "<option value='".$row['nombre']."' >".$row['nombre']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Seleccion del perfil-->

                        <div class="form-group">
                            <label for="perfilM"><?php  echo $literales['seleccion perfil']?></label>
                            <select id="perfilM" name="perfilM"style="width: 200px" class=" form-control">
                                <?php
                                $perfiles= Perfil_modelo::listarPerfiles();
                                while($row = mysqli_fetch_assoc($perfiles)){
                                    echo "<option value='".$row['nombre']."' >".$row['nombre']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-danger"value="<?php echo $literales['modificar']?>"type="submit">
                        <a class="btn btn-default" href="PERMISO_Controller.php?id=SHOWALLPERMISO&ctr=PERMISO";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>