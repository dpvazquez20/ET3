<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/FACTURA_Model.php');

class Factura_show{

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
                $resul = Factura_model::getFactura($_GET['idFactura']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success">Estos son los datos de la factura</div>

                <form role="form" action="FACTURA_Controller.php?id=SHOWFACTURA&ctr=FACTURA" method="POST">
                    <div class="form-group">
                      

                        <label for="controlador">ID Factura</label>
                        <input  type="text" class="form-control" id="id_factura" name="id_factura" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="accionB">ID Proveedor</label>
                        <input  type="text" class="form-control" id="id_proveedor" name="id_proveedor" readonly="readonly"
                                value="<?php  echo $row['id_proveedor']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB">NIF</label>
                        <input  type="text" class="form-control" id="NIF" name="NIF" readonly="readonly"
                                value="<?php  echo $row['NIF']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB">Fecha</label>
                        <input  type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                                value="<?php  echo $row['fecha']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <a class="btn btn-default" href="FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA";"><?php echo $literales['volver'];?></a>
                    </div>

                </form>



                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>ID_Linea</th>
                        <th>ID_Albaran</th>
                        
                      
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    //Lineas albaran
                    $resul= Factura_Model::getLineasFactura($_GET['idFactura']);
                    //$resul= Factura_Model::listar();
                    //var_dump($resul);
                    $controladorAct = "FACTURA";
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['id_linea'] . "</td> <td>" . $row['id_albaran'] . "</td> <td>";
                       
                        
                        echo"</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>