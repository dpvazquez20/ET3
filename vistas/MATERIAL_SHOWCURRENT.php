<?php



if(!isset($_SESSION)){
    session_start();
}

include_once('../modelos/MATERIAL_Model.php');

class Material_show{

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

        <title><?php echo $literales['detalleMaterial']; ?></title>

                <?php
                $resul = Material_modelo::getMaterial($_GET['idMaterial']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success"><?php echo $literales['materialSHOW']?></div>
                <form>
                    
                    <div class="form-group">
                        <label for="idB"><?php echo $literales['materialID']; ?></label>
                        <input  type="text" class="form-control" id="idB" name="idB" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="nombreB"><?php echo $literales['materialNombre']; ?></label>
                        <input  type="text" class="form-control" id="nombreB" name="nombreB" readonly="readonly"
                                value="<?php  echo utf8_decode($row['nombre'])?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcionB"><?php echo $literales['materialDescripcion']; ?></label>
                        <input type="text" class="form-control" id="descripcionB" name="descripcionB" readonly="readonly"
                               value="<?php echo utf8_decode($row['descripcion'])?>">
                    </div>

                    <div class="form-group">
                            <a class="btn btn-default"href="MATERIAL_Controller.php?id=SHOWALLMATERIAL&ctr=MATERIAL"><?php echo $literales['volverMaterial'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>