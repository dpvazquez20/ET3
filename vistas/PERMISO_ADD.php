<?php

require_once ('../modelos/ACCION_Model.php');
require_once ('../modelos/CONTROLADOR_Model.php');
require_once ('../modelos/PERFIL_Model.php');
if(!isset($_SESSION)){
    session_start();
}
class Permiso_add{

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
                <div class="alert alert-info"><?php echo $literales['permisoADD']?> </div>

                <form role="form" action="PERMISO_Controller.php?id=ADDPERMISO&ctr=PERMISO" method="POST">

                    <!-- Seleccion del controlador-->
                    <div class="form-group">
                        <label for="controlador"><?php  echo $literales['seleccion controlador']?></label>
                        <select id="controlador" name="controlador"style="width: 200px" class=" form-control">
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
                        <label for="accion"><?php  echo $literales['seleccion accion']?></label>
                        <select id="accion" name="accion"style="width: 200px" class=" form-control">
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
                        <label for="perfil"><?php  echo $literales['seleccion perfil']?></label>
                        <select id="perfil" name="perfil"style="width: 200px" class=" form-control">
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
                        <div class="col-sm-4"><input id="enviar" name="enviar" class="btn btn-primary"value="Enviar" type="submit">
                            <a class="btn btn-default" href="PERMISO_Controller.php?id=SHOWALLPERMISO&ctr=PERMISO";">&laquo; <?php echo $literales['cancelar'];?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>