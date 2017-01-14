<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}


class Stock_producto_add
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
                <script>
                    $( function() {
                        $( "#fecha" ).datepicker();
                    } );
                </script>
                <title><?php echo $literales['addStock']; ?></title>
                <div class="alert alert-info"><?php echo $literales['stockADD'] ?> </div>

                <form role="form" action="STOCK_PRODUCTO_Controller.php?id=ADDSTOCK_PRODUCTO&ctr=STOCK_PRODUCTO" method="POST">

                    <div class="form-group">
                        <label for="material"><?php echo "Material";?></label>
                        <select name="material" id="material" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Producto_modelo::listarProducto();?>
                            <?php while($rowM = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowM["id_producto"] ?>"><?= $rowM["nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha"><?php  echo $literales['fecha']?></label>
                        <input type="text" class="form-control" id="fecha" name="fecha">
                    </div>

                    <div  style="align-items: center" class="form-group">
                            <label for="precio"><?php  echo $literales['precio']?></label>
                            <input  type="text" class="form-control" id="precio" name="precio"
                                    placeholder="Precio">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $literales['sumarStock']; ?>" type="submit">
                            <a class="btn btn-default" href="STOCK_PRODUCTO_Controller.php?id=SHOWALLSTOCK_PRODUCTO&ctr=STOCK_PRODUCTO"><?php echo $literales['cancelarStock']; ?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>