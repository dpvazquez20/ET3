<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ALBARAN_Model.php');
class Linea_Albaran_show{

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

                <title><?php echo $literales['mostrarLinea']; ?></title>
                <?php $resul = Albaran_Model::getLineaAlbaran($_GET['idLineaAlbaran']);
                $row= mysqli_fetch_assoc($resul);

                ?>

                <div class="alert alert-success"><?php echo $literales['lineaAlbaranSHOW']?></div>
                <form>

                 <input type="hidden"  class="form-control" id="id_linea" name="id_linea" <?php echo 'value="'.$_GET['idLineaAlbaran'].'"'?> >
                                    <input type="hidden" class="form-control" id="id_albaran" name="id_albaran"
                                       value="<?php echo $row['id_albaran']?>">

                    <div  style="align-items: center" class="form-group">
                        <label for="IDMaterialE"><?php echo $literales['material']?></label>
                        <select disabled id="id_material" readonly="readonly" name="id_material" style="width: 200px" class=" form-control">
                                    <?php
                                    //CAMBIAR POR MODELO MATERIAL
                                    $materiales= Albaran_Model::listarMateriales();
                                    while($matAct = mysqli_fetch_assoc($materiales)){
                                        $selected ="";
                                        if($matAct['id']==$row['id_material']){
                                            $selected ='selected="selected"';
                                        }
                                        echo "<option ".$selected." value='".$matAct['id']."' >".$matAct['nombre']."</option>";
                                    }
                                    ?>
                                </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidadE"><?php echo $literales['cantidad']?></label>
                        <input type="number" readonly="readonly" class="form-control" id="cantidad" name="cantidad" <?php echo 'value="'.$row['cantidad'].'"'?> >
                    </div>

                    <div class="form-group">
                        <a class="btn btn-default"href="ALBARAN_Controller.php?id=SHOWALBARAN&ctr=ALBARAN&idAlbaran=<?php echo $row['id_albaran'];?>"">&laquo; Volver atrás</a>
                    </div>


                </form>
            </div>
        </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>