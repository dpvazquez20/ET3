<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/CONTROLADOR_Model.php');

class Controlador_edit{

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
                    $resul = Controlador_modelo::getControlador($_GET['nombreControlador']);
                    $row = mysqli_fetch_assoc($resul);

                ?>
                <div class="alert alert-warning">¿Esta seguro que desea modificar el controlador?</div>

                <form role="form" action="CONTROLADOR_Controller.php?id=EDITCONTROLADOR&ctr=CONTROLADOR" method="POST">
                    <input type="hidden" id="nombreAModificar" name="nombreAModificar" value="<?php echo $row['nombre']?>">
                    <div class="form-group">
                        <label for="nombreM">Nombre</label>
                        <input  type="text" class="form-control" id="nombreM" name="nombreM"
                                value="<?php  echo $row['nombre']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>"type="submit">
                        <a class="btn btn-default" href="CONTROLADOR_Controller.php?id=SHOWALLCONTROLADOR&ctr=CONTROLADOR";">&laquo; <?php echo $literales['cancelar'];?></a>
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