<?php

if(!isset($_SESSION)){
    session_start();
}
class Usuario_delete{

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
                <?php $resul = getUsuario($_GET['idUser']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <script type="text/javascript">
                    function borrar() {
                        var mensaje = confirm("¿Estas seguro que deseas borrar el usuario?");
                        if(mensaje){
                            alert("Quieres borrarlo");
                        }else{
                            alert("No estas tan seguro no?")
                        }
                        }


                </script>
                <div class="alert alert-danger"><?php echo $literales['usuarioDELETE']?></div>
                <form role="form" action="USUARIO_Controller.php?id=DELETEUSUARIO&ctr=USUARIO" method="POST">
                    <div class="form-group">
                        <label for="NombreE">Nombre</label>
                        <input type="text" class="form-control" id="NombreE" name="NombreE" readonly="readonly"
                              value="<?php echo $row['nombre']?>">
                    </div>
                    <div class="form-group">
                        <label for="apellidoE">Apellido</label>
                        <input type="text" class="form-control" id="apellidoE" name="apellidoE" readonly="readonly"
                               value="<?php echo $row['apellido']?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="DNIE">DNI</label>
                        <input type="text" class="form-control" id="DNIE" name="DNIE" readonly="readonly"
                               value="<?php echo $row['DNI']?>">
                    </div>
                    <div class="form-group">
                        <label for="passwordE">Password</label>
                        <input  type="password" class="form-control" id="passwordE" name="passwordE" readonly="readonly"
                               value="<?php echo $row['password']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilE">Password</label>
                        <input  type="perfilE" class="form-control" id="perfilE" name="perfilE" readonly="readonly"
                               value="<?php echo $row['perfil']?>">
                    </div>

                    <div class="form-group">
                            <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                            <a class="btn btn-default" href="USUARIO_Controller.php?id=SHOWALLUSUARIO&ctr=USUARIO";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>