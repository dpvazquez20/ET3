<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ACCION_Model.php');

class Accion_edit{

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

                $resul= Accion_modelo::getAccion($_GET['nombreControlador']);
                $row = mysqli_fetch_assoc($resul);

                ?>
                <div class="alert alert-warning"><?php echo $literales['accionMODIFY']?></div>

                <form role="form" action="ACCION_Controller.php?id=EDITACCION&ctr=ACCION" method="POST">
                    <input type="hidden" id="nombreAModificar" name="nombreAModificar" value="<?php echo $row['nombre']?>">
                    <div class="form-group">
                        <label for="nombreM">Nombre</label>
                        <input  type="text" class="form-control" id="nombreM" name="nombreM"
                                value="<?php  echo $row['nombre']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>"type="submit">
                        <a class="btn btn-default" href="ACCION_Controller.php?id=SHOWALLACCION&ctr=ACCION";">&laquo; <?php echo $literales['cancelar'];?></a>
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