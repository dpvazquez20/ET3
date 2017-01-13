<?php

if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/FACTURA_Model.php');
class Linea_Factura_delete{

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

                <title><?php echo $literales['borrarLinea']; ?></title>
                <?php $resul = Factura_Model::getLineaFactura($_GET['idLineaFactura']);
                $row= mysqli_fetch_assoc($resul);

                ?>

                <div class="alert alert-danger"><?php echo $literales['lineaFacturaDELETE']?></div>
                <form role="form" action="FACTURA_Controller.php?id=DELETELINEAFACTURA&ctr=FACTURA?>" method="POST">

                 <input type="hidden"  class="form-control" id="id_linea" name="id_linea" <?php echo 'value="'.$_GET['idLineaFactura'].'"'?> >
                                    <input type="hidden" class="form-control" id="id_factura" name="id_factura"
                                       value="<?php echo $row['id_factura']?>">

                    <div  style="align-items: center" class="form-group">
                        <label for="IDMaterialE"><?php echo $literales['idAlbaran'] ?></label>
                        <select id="id_albaran" readonly="readonly"  name="id_albaran" style="width: 200px" class=" form-control">
                                    <?php
                                    //CAMBIAR POR MODELO MATERIAL
                                    $albaranes= Albaran_Model::listar();
                                    while($albAct = mysqli_fetch_assoc($albaranes)){
                                        $selected ="";
                                        if($albAct['id']==$lineaAct['id_albaran']){
                                            $selected ='selected="selected"';
                                        }
                                        echo "<option ".$selected." value='".$albAct['id']."' >".$albAct['id']."</option>";
                                    }
                                    ?>
                                </select>
                    </div>
                  

                    <div class="form-group">
                        <input id ="deletelinea" name="deletelinea"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                        <a class="btn btn-default" href="FACTURA_Controller.php?id=SHOWFACTURA&ctr=FACTURA&idFactura=<?php echo $row['id_factura'];?>";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>