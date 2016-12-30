<?php

    if (!isset($_SESSION)) {
        session_start();
    }
require_once ('../modelos/PERFIL_Model.php');


class Usuario_add
    {

        function __construct()
        {
            $this->render();
        }

        function render()
        {
            include_once('cabecera.php');
            ?>
            <div class="row-fluid">
                <?php include('menu.php'); ?>
                <!-- Título de la página -->
                <div class="col-sm-9">

                    <title><?php echo $literales['nuevo usuario']; ?></title>

                    <div class="alert alert-info"><?php echo $literales['usuarioADD'] ?></div>

                    <form role="form" action="USUARIO_Controller.php?id=ADDUSUARIO&ctr=USUARIO" method="POST">
                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"
                                   required
                                   placeholder="Introduce nombre del usuario">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido"
                                   pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                                   required
                                   placeholder="Apellido">
                        </div>
                        <div style="align-items: center" class="form-group">
                            <label for="DNI">DNI</label>
                            <input type="text" class="form-control" id="DNI" name="DNI" required
                                   pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                                   placeholder="DNI/NIE Usuario">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   pattern="[A-Za-z0-9!?-]{8,12}" required
                                   placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <label for="perfil"><?php echo $literales['seleccion perfil'] ?></label>
                            <select id="perfil" name="perfil" style="width: 200px" class=" form-control">
                                <?php
                                $perfiles = Perfil_modelo::listarPerfiles();
                                while ($row = mysqli_fetch_assoc($perfiles)) {
                                    echo "<option value='" . $row['nombre'] . "' >" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4"><input class="btn btn-primary" value="Enviar" type="submit">
                                <input class="btn btn-default" value="<?php echo $literales['reset']; ?>" type="reset">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <?php include_once('pieDePagina.php');
        }
    }
?>