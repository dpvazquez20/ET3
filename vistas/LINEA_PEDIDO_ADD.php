<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

require_once ('../modelos/MATERIAL_Model.php');

class Linea_Pedido_add{

    function __construct(){
        $this->render();
    }

    //Formulario para rellenar los datos y crear una linea de pedido. Los datos a
    //rellenar son material, cantidad, estado, precio unitario sin iva, y la iva

    function render(){
        include_once('cabecera.php');
        ?>
        <div class="row-fluid">
            <?php include ('menu.php');?>
            <!-- Título de la página -->
            <div class="col-sm-9">

                <title><?php echo $literales['nuevo linea de pedido']; ?></title>

                <div class="alert alert-info"><?php echo $literales['lineaADD']?></div>

                <form role="form" action="PEDIDO_Controller.php?id=ADDLINEAPEDIDO&ctr=PEDIDO&idPedido=<?php echo $_GET['idPedido'];?>" method="POST">
                    <div  style="align-items: center" class="form-group">
                        <label for="id_pedido"><?php echo $literales['id pedido']?></label>
                        <input  type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                                value="<?php echo $_GET['idPedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_material"><?php echo $literales['material']?></label>
                        <select name="nombre_material" class="form-control" required>
                            <option value="" selected></option>
                            <?php $resul = Material_modelo::listarMateriales();?>
                            <?php while($rowM = mysqli_fetch_assoc($resul)){?>
                                <option value="<?php echo $rowM["id"] ?>"><?= "Nombre: " . $rowM["nombre"].$literales['descripcion']. $rowM["descripcion"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad"><?php echo $literales['cantidad']?></label>
                        <input type="number" name="cantidad" class="form-control" placeholder="ej. 120" id="cantidad" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="estado"><?php echo $literales['estado']?></label>
                        <select id="estado" name="estado" style="width: 200px" class=" form-control" required>
                            <option value="completa"><?php echo $literales['completa']?></option>
                            <option value="pendiente"><?php echo $literales['pendiente']?></option>
                            <option value="por llegar"><?php echo $literales['por llegar']?></option>
                        </select>
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="precio"><?php echo $literales['precio']?></label>
                        <input  type="number" class="form-control" id="precio" name="precio" min="0" required
                                placeholder="ej. 120">
                    </div>
                    <div class="form-group">
                        <label for="iva">IVA</label>
                        <input type="number" name="iva" class="form-control" placeholder="ej. 16" id="iva" min="0" max="50" required>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary"value="Enviar" type="submit">
                            <input class="btn btn-default" value="<?php echo $literales['reset']; ?>" type="reset"></div>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}

?>