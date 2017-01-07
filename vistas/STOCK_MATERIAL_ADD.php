<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}


class Stock_material_add
{

    function __construct()
    {
        $this->render();
    }

    function render()
    {
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include('menu.php'); ?>
            <!-- Título de la página -->
            <div class="col-sm-9">
                <title><?php echo $literales['addStock']; ?></title>
                <div class="alert alert-info"><?php echo $literales['stockADD'] ?> </div>

                <form role="form" action="STOCK_MATERIAL_Controller.php?id=ADDSTOCK_MATERIAL&ctr=STOCK_MATERIAL" method="POST">                    
                    
                    <div class="form-group">
                        <label for="Id_material"><?php echo $literales['stockId_material']; ?></label>
                        <select name="Id_material" class="form-control" required>
                        <?php
                            $resul = Stock_material_modelo::getMateriales();
                            if($row = mysqli_fetch_assoc($resul)){
                                echo "<option value='".$row['id']."' selected>". utf8_decode($row['nombre']) ."</option>";
                            }
                            while($row = mysqli_fetch_assoc($resul)){
                                echo "<option value='".$row['id']."'>". utf8_decode($row['nombre'])."</option>"; 
                            }       
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Id_albaran"><?php echo $literales['stockId_albaran']; ?></label>
                        <select name="Id_albaran" class="form-control" required>
                        <?php
                            $resul = Stock_material_modelo::getAlbaranes();
                            if($row = mysqli_fetch_assoc($resul)){
                                echo "<option value='".$row['id']."' selected>".$row['id']."</option>"; 
                            }
                            while($row = mysqli_fetch_assoc($resul)){
                                echo "<option value='".$row['id']."'>".$row['id']."</option>"; 
                            }       
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Id_producto"><?php echo $literales['stockId_producto']; ?></label>
                        <select name="Id_producto" class="form-control" required>
                        <?php
                            $resul = Stock_material_modelo::getProductos();
                            echo "<option value='null'>(No asignado)</option>";
                            while($row = mysqli_fetch_assoc($resul)){
                                echo "<option value='".$row['id']."'>".utf8_decode($row['nombre'])."</option>"; 
                            }       
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $literales['sumarStock']; ?>" type="submit">
                            <a class="btn btn-default" href="STOCK_MATERIAL_Controller.php?id=SHOWALLSTOCK_MATERIAL&ctr=STOCK_MATERIAL"><?php echo $literales['cancelarStock']; ?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>