<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

include_once ('../modelos/FACTURA_Model.php');
include_once ('../modelos/ALBARAN_Model.php');

class Factura_edit{

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
                $factura = mysqli_fetch_assoc($resul);
                ?>
                <div class="alert alert-success">Estos son los datos del factura</div>

                 <form role="form" action="FACTURA_Controller.php?id=EDITFACTURA&ctr=FACTURA" method="POST">

                  

                               <label for="idFactura">ID factura</label>
                        <input  type="text" class="form-control" id="id_factura" name="id_factura" readonly="readonly"
                                value="<?php  echo $factura['id']?>">

                    <!-- Seleccion del proveedor-->
                    <div class="form-group">
                        <label for="proveedor"><?php  echo $literales['selectPedido']?></label>
                        <select id="id_proveedor" name="id_proveedor"style="width: 200px" class=" form-control">
                            <?php
                            //CAMBIAR POR MODELO PEDIDO
                            $proveedores= Factura_Model::listarProveedores();
                            while($row = mysqli_fetch_assoc($proveedores)){
                                $selected ="";
                                if($row['id']==$factura['id_proveedor']){
                                    $selected ='selected="selected"';
                                }
                                
                                echo "<option ".$selected." value='".$row['id']."' >".$row['id']."</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="Nombre">NIF</label>
                        <input type="text" class="form-control" id="NIF" name="NIF" <?php echo 'value="'.$factura['NIF'].'"';?>  >
                    </div>

                <!-- Seleccion de la fecha-->
                    <div class="form-group">
                            <label for="fecha"><?php  echo $literales['inputFecha']?></label>
                            <input type="date" class="form-control" id="fecha" name="fecha" <?php echo 'value="'.$factura['fecha'].'"';?>>
                        </div>
                    <div class="form-group">
                            <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                            <a class="btn btn-default" href="../controladores/FACTURA_Controller.php?id=SHOWALLFACTURA&ctr=FACTURA";">&laquo; Volver atrás</a>
                    </div>

                </form>

                <!--PARTE LINEA FACTURA !-->
                <div class="form-group">
                     <form role="form" action="FACTURA_Controller.php?id=ADDLINEAFACTURA&ctr=FACTURA" method="POST">

                     <input type="hidden" class="form-control" id="id_factura" name="id_factura"
                               value="<?php echo $factura['id']?>">

                    <!-- Seleccion del proveedor-->
                    <div class="form-group">
                        <label for="id_albaran">Albaran</label>
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
                        <div class="col-sm-4"><input id="addlinea" name="addlinea" class="btn btn-primary" value="AñadirLinea" type="submit">
                          
                        </div>

                </form>
                </div>

                <!--FIN PARTE ADD LINEA FACTURA !-->

                <table class=" table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>ID_Linea</th>
                        <th>Albaran</th>
                       
                        <th colspan="2">Acción</th>
                      
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                   
                    //Lineas factura
                    $resul= Factura_Model::getLineasFactura($_GET['idFactura']);
                    //$resul= Factura_Model::listar();
                    //var_dump($resul);
                    $controladorAct = "FACTURA";
                    while($lineaAct = mysqli_fetch_assoc($resul)) {

                                 ?>
                                 <tr>

                            
                     
                             <form role="form" action="FACTURA_Controller.php?id=EDITLINEAFACTURA&ctr=FACTURA" method="POST" onsubmit="return confirm('Confirmar modificacion');">

                             <input type="hidden" class="form-control" id="id_factura" name="id_factura"
                                       value="<?php echo $factura['id']?>">

                           <td>
                                    <input type="id_linea" readonly="readonly" class="form-control" id="id_linea" name="id_linea" <?php echo 'value="'.$lineaAct['id_linea'].'"'?> >
                            </td>

                            <td>

                          
                                <select id="id_albaran" name="id_albaran" style="width: 200px" class=" form-control">
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
                             </td>
                            
                       
                        

                            <td>
                                <input id="editlinea" name="editlinea" class="btn btn-primary" value="Actualizar" type="submit">
                                  
                              </td> 

                        </form>
                        <td>

                            <form role="form" action="FACTURA_Controller.php?id=DELETELINEAFACTURA&ctr=FACTURA" method="POST" onsubmit="return confirm('Confirmar borrado');">
                                 
                                    <input type="hidden"  class="form-control" id="id_linea" name="id_linea" <?php echo 'value="'.$lineaAct['id_linea'].'"'?> >
                                    <input type="hidden" class="form-control" id="id_factura" name="id_factura"
                                       value="<?php echo $factura['id']?>">
                          
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