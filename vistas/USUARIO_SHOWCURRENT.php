<?php

if(!isset($_SESSION)){
    session_start();
}
class Usuario_show{

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

                <title><?php echo $literales['eliminar usuario']; ?></title>

                <?php
                $resul = getUsuario($_GET['idUser']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['usuarioSHOW']?></div>
                <form>
                    <div class="form-group">
                        <label for="nombreS">Nombre</label>
                        <input type="text" class="form-control" id="nombreS" name="nombreS" readonly="readonly"
                              value="<?php echo $row['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidoS">Apellido</label>
                        <input type="text" class="form-control" id="apellidoS" name="apellidoS" readonly="readonly"
                               value="<?php echo $row['apellido']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="DNIS">DNI</label>
                        <input type="text" class="form-control" id="DNIS" name="DNIS" readonly="readonly"
                               value="<?php echo $row['DNI']?>">
                    </div>
                    <div class="form-group">
                        <label for="passwordS">Password</label>
                        <input type="password" class="form-control" id="passwordE" name="passwordS" readonly="readonly"
                               value="<?php echo $row['password']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilS">Password</label>
                        <input style="width: 300px" type="perfilS" class="form-control" id="perfilS" name="perfilS" readonly="readonly"
                               value="<?php echo $row['perfil']?>">
                    </div>

                    <div class="form-group">
                            <a class="btn btn-default"href="USUARIO_Controller.php?id=SHOWALLUSUARIO&ctr=USUARIO"">&laquo; Volver atrás</a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>