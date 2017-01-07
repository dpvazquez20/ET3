<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/STOCK_MATERIAL_Model.php');

class Stock_material_edit{

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
                <title><?php echo $literales['editarStock']; ?></title>
                <?php

                $resul= Stock_material_modelo::getStock($_GET['idStock']);
                $row = mysqli_fetch_assoc($resul);
                $generalId=$row['id'];
                $generalMat=$row['id_material'];
                $generalAlb=$row['id_albaran'];
                $generalPro=$row['id_producto'];
                ?>
                <div class="alert alert-warning"><?php echo $literales['stockMODIFY']?></div>

                <form role="form" action="STOCK_MATERIAL_Controller.php?id=EDITSTOCK_MATERIAL&ctr=STOCK_MATERIAL" method="POST">  
                    
                    <input type="hidden" id="idB" name="idB" value="<?php echo $row['id']?>">
                    <div class="form-group">
                        <label for="idB"><?php echo $literales['stockId'] ?></label>
                        <input  type="text" class="form-control" id="idB" name="idB" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="id_materialM"><?php echo $literales['stockId_material']; ?></label>
                        <select name="id_materialM" required>
                        <?php
                            $resul = Stock_material_modelo::getMateriales();
                            while($row = mysqli_fetch_assoc($resul)){
                                if($row['id']==$generalMat){
                                    echo "<option value='".$row['id']."' selected>".utf8_decode($row['nombre'])."</option>";
                                }else{
                                    echo "<option value='".$row['id']."'>".utf8_decode($row['nombre'])."</option>";
                                }                                
                            }      
                        ?>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="id_albaranM"><?php echo $literales['stockId_albaran']; ?></label>
                        <select name="id_albaranM" required>
                        <?php
                            $resul = Stock_material_modelo::getAlbaranes();
                            while($row = mysqli_fetch_assoc($resul)){
                                if($row['id']==$generalAlb){
                                    echo "<option value='".$row['id']."' selected>".$row['id']."</option>";
                                }else{
                                    echo "<option value='".$row['id']."'>".$row['id']."</option>";
                                }                                
                            }      
                        ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_productoM"><?php echo $literales['stockId_producto']; ?></label>
                        <select name="id_productoM" required>
                        <?php
                            $resul = Stock_material_modelo::getProductos();
                            echo "<option value='null'>(No asignado)</option>";
                            while($row = mysqli_fetch_assoc($resul)){
                                if($row['id']==null && $row['id']==$generalPro){
                                    "<option value='null' selected>(No asignado)</option>";
                                }else{
                                    if($row['id']==$generalPro && $row['id']!=null){
                                        echo "<option value='".$row['id']."' selected>".utf8_decode($row['nombre'])."</option>";
                                    }else{
                                        echo "<option value='".$row['id']."'>".utf8_decode($row['nombre'])."</option>";
                                    }
                                }
                            }       
                        ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificarStock']?>"type="submit">
                        <a class="btn btn-default" href="STOCK_MATERIAL_Controller.php?id=SHOWALLSTOCK_MATERIAL&ctr=STOCK_MATERIAL"> <?php echo $literales['cancelarStock'];?></a>
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