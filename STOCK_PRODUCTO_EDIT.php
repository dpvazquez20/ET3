<?php

    //Si no hay una sesión iniciada, la inicia.
    if(!isset($_SESSION)){
        session_start();
    }
    include_once ('../modelos/STOCK_PRODUCTO_Model.php');
    class Stock_producto_edit{

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
                    <script>
                        $( function() {
                            $( "#fechaM" ).datepicker();
                        } );
                    </script>
                    <title><?php echo $literales['borrarStock']; ?></title>
                    <?php
                            $resul= Stock_producto_modelo::getStock($_GET['idStock']);
                            $row = mysqli_fetch_assoc($resul);
                            $producto = Producto_modelo::getProducto($row['id_producto']);
                            $rowAux= mysqli_fetch_assoc($producto);
                    ?>
                    <div class="alert alert-warning"><?php echo $literales['stockMODIFY']?></div>

                    <form role="form" action="STOCK_PRODUCTO_Controller.php?id=EDITSTOCK_PRODUCTO&ctr=STOCK_PRODUCTO" method="POST">

                        <div class="form-group">
                            <input  type="hidden" class="form-control" id="idM" name="idM" readonly="readonly"
                                    value="<?php echo $row['id']?>">
                        </div>

                        <div class="form-group">
                            <label for="productoM"><?php echo $literales['producto']?></label>
                            <select name="productoM" id="productoM" class="form-control">
                                <option value=""></option>
                                <?php $resul = Producto_modelo::listarProducto();?>
                                <?php while($rowM = mysqli_fetch_assoc($resul)){
                                    if($rowM['id_producto']==$rowAux['id_producto']) { ?>
                                        <option selected value="<?php echo $rowM["id_producto"] ?>"><?= $rowM["nombre"] ?></option>
                                    <?php }else {
                                        ?>
                                        <option value="<?php echo $rowM["id_producto"] ?>"><?= $rowM["nombre"] ?></option>
                                        <?php
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fechaM"><?php  echo $literales['fecha']?></label>
                            <input type="text" class="form-control" id="fechaM" name="fechaM" value="<?php echo $row['fecha'] ?>">
                        </div>

                        <div  style="align-items: center" class="form-group">
                            <label for="precioM"><?php  echo $literales['precio']?></label>
                            <input  type="text" class="form-control" id="precioM" name="precioM" value="<?php echo $row['coste']?>">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <input id ="modificar" name="modificar"class="btn btn-warning"value="<?php echo $literales['modificar']?>" type="submit">
                            <a class="btn btn-default" href="STOCK_PRODUCTO_Controller.php?id=SHOWALLSTOCK_PRODUCTO&ctr=STOCK_PRODUCTO"> <?php echo $literales['cancelarStock'];?></a>
                        </div>

                    </form>
                </div>
            </div>

            <?php include_once ('pieDePagina.php');
        }
    }
?>