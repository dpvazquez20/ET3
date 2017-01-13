<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/ALBARAN_Model.php');

class Linea_Albaran_add{

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

                <title><?php echo $literales['newLineaAlbaran']; ?></title>

                <div class="alert alert-info"><?php echo $literales['lineaAlbaranADD']?></div>

                <form role="form" action="ALBARAN_Controller.php?id=ADDLINEAALBARAN&ctr=ALBARAN" method="POST">
                    
                     <input type="hidden" class="form-control" id="id_albaran" name="id_albaran"
                               value="<?php echo $_GET['idAlbaran']?>">

                    <!-- Seleccion del pedido-->
                    <div class="form-group">
                        <label for="id_material"><?php echo $literales['material']?></label>
                        <select id="id_material" name="id_material" style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PEDIDO
                            $materiales= Albaran_Model::listarMateriales();
                            while($row = mysqli_fetch_assoc($materiales)){
                                echo "<option value='".$row['id']."' >".$row['nombre']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="cantidad"><?php echo $literales['cantidad']?></label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required placeholder=<?php echo $literales['cantidad']?>>
                        </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input id="addlinea" name="addlinea" class="btn btn-primary" value="<?php echo $literales['añadirLinea']?>" type="submit">
                          
                        </div>
                    

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}

?>