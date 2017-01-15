<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/MATERIAL_Model.php');

class Material_edit{

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
                <title><?php echo $literales['editarMaterial']; ?></title>
                <?php

                $resul= Material_modelo::getMaterial($_GET['idMaterial']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-warning"><?php echo $literales['materialMODIFY']?></div>

                <form role="form" action="MATERIAL_Controller.php?id=EDITMATERIAL&ctr=MATERIAL" method="POST">
                    
                    <input type="hidden" id="idB" name="idB" value="<?php echo utf8_decode($row['id'])?>">
                    <div class="form-group">
                        <label for="idB"><?php echo $literales['materialID'] ?></label>
                        <input  type="text" class="form-control" id="idB" name="idB" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    
                    <input type="hidden" id="nombreAModificar" name="nombreAModificar" value="<?php echo utf8_decode($row['nombre'])?>">
                    <div class="form-group">
                        <label for="nombreM"><?php echo $literales['materialNombre'] ?></label>
                        <input  type="text" class="form-control" id="nombreM" name="nombreM" required
                                value="<?php  echo utf8_decode($row['nombre'])?>">
                    </div>
                    
                    <input type="hidden" id="descripcionAModificar" name="descripcionAModificar" value="<?php echo utf8_decode($row['descripcion'])?>">
                    <div class="form-group">
                        <label for="descripcionM"><?php echo $literales['materialDescripcion'] ?></label>
                        <input  type="text" class="form-control" id="nombreM" name="descripcionM" required
                                value="<?php  echo utf8_decode($row['descripcion'])?>">
                    </div>
                    
                    

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificarMaterial']?>"type="submit">
                        <a class="btn btn-default" href="MATERIAL_Controller.php?id=SHOWALLMATERIAL&ctr=MATERIAL"> <?php echo $literales['cancelarMaterial'];?></a>
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