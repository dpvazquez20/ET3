<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/FACTURA_Model.php');
require_once ('../modelos/ALBARAN_Model.php');

class Linea_Factura_add{

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

                <title><?php echo $literales['añadirLinea']; ?></title>

                <div class="alert alert-info"><?php echo $literales['lineaFacturaADD']?></div>

                <form role="form" action="FACTURA_Controller.php?id=ADDLINEAFACTURA&ctr=FACTURA"" method="POST">
                    
                    <input type="hidden" class="form-control" id="id_factura" name="id_factura"
                               value="<?php echo $_GET['idFactura']?>">

                    <!-- Seleccion del proveedor-->
                    <div class="form-group">
                        <label for="id_albaran"><?php echo $literales['idAlbaran'] ?></label>
                        <select id="id_albaran" name="id_albaran" style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PEDIDO
                            $albaranes= Albaran_Model::listar();
                            while($row = mysqli_fetch_assoc($albaranes)){
                                echo "<option value='".$row['id']."' >".$row['id']."</option>";
                            }
                            ?>
                        </select>
                    </div>
        
                   

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input id="addlinea" name="addlinea" class="btn btn-primary" value="<?php echo $literales['añadirLinea'] ?>" type="submit">
                          
                        </div>

                    

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}

?>