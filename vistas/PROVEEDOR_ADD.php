<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

class Proveedor_add{

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

                <title><?php echo $literales['nuevo proveedor']; ?></title>

                <div class="alert alert-info"><?php echo $literales['proveedorADD']?></div>

                <form role="form" action="PROVEEDOR_Controller.php?id=ADDPROVEEDOR&ctr=PROVEEDOR" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input  type="text" class="form-control" id="nombre" name="nombre" required
                                placeholder="Introduce nombre del proveedor">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="NIF">NIF</label>
                        <input  type="text" class="form-control" id="NIF" name="NIF" required pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))"
                                placeholder="NIF Proveedor">
                    </div>
                    <div class="form-group">
                        <label for="correoE">Correo Electronico</label>
                        <input  type="email" class="form-control" id="correoE" name="correoE" required
                                placeholder="Correo Electronico">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="telefono">Telefono</label>
                        <input  type="tel" class="form-control" id="telefono" name="telefono" required
                                placeholder="Telefono">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input  type="text" class="form-control" id="direccion" name="direccion" required
                                placeholder="Dirección">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="codigoP">Codigo Postal</label>
                        <input  type="number" class="form-control" id="codigoP" name="codigoP" required
                                placeholder="Codigo Postal">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input  type="text" class="form-control" id="ciudad" name="ciudad" required
                                placeholder="Ciudad">
                    </div>
                    <div class="form-group">
                    <label for="provincia">Provincia</label>
                    <input  type="text" class="form-control" id="provincia" name="provincia" required
                            placeholder="Provincia">
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