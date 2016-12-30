<?php

if(!isset($_SESSION)){
    session_start();
}
require_once ('../modelos/PERFIL_Model.php');

class Usuario_edit{

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
                <?php $resul = getUsuario($_GET['idUser']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-warning"><?php echo $literales['usuarioMODIFY']?></div>
                <form role="form" action="USUARIO_Controller.php?id=EDITUSUARIO&ctr=USUARIO" method="POST">

                        <input type="hidden" class="form-control" id="id_usuario" name="id_usuario"
                               value="<?php echo $row['id_usuario']?>">
                    <div class="form-group">
                        <label for="nombreM">Nombre</label>
                        <input type="text" class="form-control" id="nombreM" name="nombreM" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" required
                               value="<?php echo $row['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidoM">Apellido</label>
                        <input type="text" class="form-control" id="apellidoM" name="apellidoM" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required
                               value="<?php echo $row['apellido']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="DNIM">DNI</label>
                        <input type="text" class="form-control" id="DNIM" name="DNIM" required pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                               value="<?php echo $row['DNI']?>">
                    </div>
                    <div class="form-group">
                        <label for="passwordM">Password</label>
                        <input type="password" class="form-control" id="passwordM" name="passwordM" pattern="[A-Za-z0-9!?-]{8,12}" required
                               value="<?php echo $row['password']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfil"><?php  echo $literales['seleccion perfil']?></label>
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
                            <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                            <a class="btn btn-default" href="../controladores/USUARIO_Controller.php?id=SHOWALLUSUARIO&ctr=USUARIO";">&laquo; Volver atrás</a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>