<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/ALBARAN_Model.php');

class Albaran_edit{

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
                $albaran = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success">Estos son los datos del albaran</div>

                 <form role="form" action="ALBARAN_Controller.php?id=EDITALBARAN&ctr=ALBARAN" method="POST">

                  

                               <label for="idAlbaran">ID albaran</label>
                        <input  type="text" class="form-control" id="id_albaran" name="id_albaran" readonly="readonly"
                                value="<?php  echo $albaran['id']?>">

                    <!-- Seleccion del pedido-->
                    <div class="form-group">
                        <label for="pedido"><?php  echo $literales['selectPedido']?></label>
                        <select id="id_pedido" name="id_pedido"style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PEDIDO
                            $pedidos= Albaran_Model::listarPedidos();
                            while($row = mysqli_fetch_assoc($pedidos)){
                                $selected ="";
                                if($row['id']==$albaran['id_pedido']){
                                    $selected ='selected="selected"';
                                }
                                
                                echo "<option ".$selected." value='".$row['id']."' >".$row['id']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                <!-- Seleccion de la fecha-->
                    <div class="form-group">
                            <label for="fecha"><?php  echo $literales['inputFecha']?></label>
                            <input type="date" class="form-control" id="fecha" name="fecha" <?php echo 'value="'.$albaran['fecha'].'"';?>>
                        </div>
                    <div class="form-group">
                            <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                            <a class="btn btn-default" href="../controladores/ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN";">&laquo; Volver atrás</a>
                    </div>

                </form>

                <!--PARTE LINEA ALBARAN !-->
                <div class="form-group">
                     <form role="form" action="ALBARAN_Controller.php?id=ADDLINEAALBARAN&ctr=ALBARAN" method="POST">

                     <input type="hidden" class="form-control" id="id_albaran" name="id_albaran"
                               value="<?php echo $albaran['id']?>">

                    <!-- Seleccion del pedido-->
                    <div class="form-group">
                        <label for="id_material">Material</label>
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
                <!-- Seleccion de la fecha-->
                    <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad">
                        </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input id="addlinea" name="addlinea" class="btn btn-primary" value="AñadirLinea" type="submit">
                          
                        </div>

                </form>
                </div>

                <!--FIN PARTE ADD LINEA ALBARAN !-->

                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>ID_Linea</th>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th colspan="2">Acción</th>
                      
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    //Lineas albaran
                    $resul= Albaran_Model::getLineasAlbaran($_GET['idAlbaran']);
                    //$resul= Albaran_Model::listar();
                    //var_dump($resul);
                    $controladorAct = "ALBARAN";
                    while($lineaAct = mysqli_fetch_assoc($resul)) {

                                 ?>
                                 <tr>

                            
                     
                             <form role="form" action="ALBARAN_Controller.php?id=EDITLINEAALBARAN&ctr=ALBARAN" method="POST" onsubmit="return confirm('Confirmar modificacion');">

                             <input type="hidden" class="form-control" id="id_albaran" name="id_albaran"
                                       value="<?php echo $albaran['id']?>">

                           <td>
                                    <input type="id_linea" readonly="readonly" class="form-control" id="id_linea" name="id_linea" <?php echo 'value="'.$lineaAct['id_linea'].'"'?> >
                            </td>

                            <td>

                          
                                <select id="id_material" name="id_material" style="width: 200px" class=" form-control">
                                    <?php
                                    //CAMBIAR POR MODELO MATERIAL
                                    $materiales= Albaran_Model::listarMateriales();
                                    while($matAct = mysqli_fetch_assoc($materiales)){
                                        $selected ="";
                                        if($matAct['id']==$lineaAct['id_material']){
                                            $selected ='selected="selected"';
                                        }
                                        echo "<option ".$selected." value='".$matAct['id']."' >".$matAct['nombre']."</option>";
                                    }
                                    ?>
                                </select>
                             </td>
                            
                       
                            <td>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" <?php echo 'value="'.$lineaAct['cantidad'].'"'?> >
                            </td>

                            <td>
                                <input id="editlinea" name="editlinea" class="btn btn-primary" value="Actualizar" type="submit">
                                  
                              </td> 

                        </form>
                        <td>

                            <form role="form" action="ALBARAN_Controller.php?id=DELETELINEAALBARAN&ctr=ALBARAN" method="POST" onsubmit="return confirm('Confirmar borrado');">
                                 
                                    <input type="hidden"  class="form-control" id="id_linea" name="id_linea" <?php echo 'value="'.$lineaAct['id_linea'].'"'?> >
                                    <input type="hidden" class="form-control" id="id_albaran" name="id_albaran"
                                       value="<?php echo $albaran['id']?>">
                          
                                <input id="deletelinea" name="deletelinea" class="btn btn-danger" value="Borrar" type="submit">
                            </form>
                            </td>
                        </tr>

                        

                        <?php

                        
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