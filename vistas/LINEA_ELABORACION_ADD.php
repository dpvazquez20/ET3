<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/MATERIAL_Model.php');

class Linea_Elaboracion_add{

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

                <title><?php echo $literales['nuevo linea de elaboracion']; ?></title>

                <div class="alert alert-info"><?php echo $literales['elaboracionADD']?></div>


                <form role="form" action="ELABORACION_Controller.php?id=ADDLINEAELABORACION&ctr=ELABORACION&idElaboracion=<?php echo $_GET['idElaboracion'];?>" method="POST">

                    <div class="form-group">
                        <label for="id_elaboracion"><?php $literales['id_elaboracion'] ?></label>
                        <input type="number" class="form-control" id="id_elaboracion" name="id_elaboracion" value="<?php echo $_GET['idElaboracion'] ?>" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="controlador"><?php  echo $literales['seleccion material']?></label>



                        <div class="form-group">
                            <label for="material"><?php $literales['material'] ?></label>
                            <select name="material" id="material" class="form-control" required>
                                <option value="" selected></option>
                                <?php $resul = Material_modelo::listarMateriales();?>
                                <?php while($rowM = mysqli_fetch_assoc($resul)){?>
                                    <option value="<?php echo $rowM["id"] ?>"><?= $rowM["nombre"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cantidad"><?php$literales['cantidad'] ?></label>
                        <input type="number" class="form-control" min="0" id="cantidad" name="cantidad" min="1" required
                               placeholder="Introduce la cantidad de material que necesitas">
                    </div>

                    <div class="form-group">

                        
                        <div class="col-sm-4"><input class="btn btn-primary"value="Enviar" type="submit">
                            <input class="btn btn-default" value="<?php echo $literales['reset']; ?>" type="reset"></div>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}

?>