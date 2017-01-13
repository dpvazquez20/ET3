<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ALBARAN_Model.php');

class Albaran_show{

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
                $resul = Albaran_model::getAlbaran($_GET['idAlbaran']);
                $row = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success">Estos son los datos del albaran</div>

                <form role="form" action="ALBARAN_Controller.php?id=SHOWALBARAN&ctr=ALBARAN" method="POST">
                    <div class="form-group">
                      

                        <label for="controlador">ID albaran</label>
                        <input  type="text" class="form-control" id="id_albaran" name="id_albaran" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                    <div class="form-group">
                        <label for="accionB">ID Pedido</label>
                        <input  type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                                value="<?php  echo $row['id_pedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB">Fecha</label>
                        <input  type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                                value="<?php  echo $row['fecha']?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <a class="btn btn-default" href="ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN";"><?php echo $literales['volver'];?></a>
                    </div>

                </form>



                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>ID_Linea</th>
                        <th>ID_Material</th>
                        <th>Nombre material</th>
                        <th>Cantidad</th>
                      
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    //Lineas albaran
                    $resul= Albaran_Model::getLineasAlbaran($_GET['idAlbaran']);
                    //$resul= Albaran_Model::listar();
                    //var_dump($resul);
                    $controladorAct = "ALBARAN";
                    while($row = mysqli_fetch_assoc($resul)) {
                        echo "<tr><td>" . $row['id_linea'] . "</td> <td>" . $row['id_material'] . "</td> <td>". $row['material_nombre'] . "</td> <td>". $row['cantidad'] . "</td> <td>";
                       
                        
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