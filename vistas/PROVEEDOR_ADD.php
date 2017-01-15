<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}

class Proveedor_add{

    function __construct(){
        $this->render();
    }

    //Vista/formulario para rellenar los datos del proveedor,
    //incluyendo el nombre, nif, correo electronico, dirección
    //codigo postal, ciudad y provincia

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
                        <label for="nombre"><?php echo $literales['nombre proveedor'] ?></label>
                        <input  type="text" class="form-control" id="nombre" name="nombre" required
                                pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                                placeholder="<?php echo $literales['nombre proveedor'] ?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="NIF">NIF</label>
                        <input  type="text" class="form-control" id="NIF" name="NIF" required pattern="(([A-Z]{1})([0-9]{8}))"
                                placeholder="ej. R12345678">
                    </div>
                    <div class="form-group">
                        <label for="correoE"><?php echo $literales['correo electronico'] ?></label>
                        <input  type="email" class="form-control" id="correoE" name="correoE" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                placeholder="<?php echo $literales['correo electronico'] ?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="telefono"><?php echo $literales['telefono'] ?></label>
                        <input  type="tel" class="form-control" id="telefono" name="telefono" required pattern="[0-9]{9}"
                                placeholder="ej. 988123456">
                    </div>
                    <div class="form-group">
                        <label for="direccion"><?php echo $literales['direccion'] ?></label>
                        <input  type="text" class="form-control" id="direccion" name="direccion" required
                                pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                                placeholder="ej. Calle Lazaro, 12">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="codigoP"><?php echo $literales['codigo postal'] ?></label>
                        <input  type="text" class="form-control" id="codigoP" name="codigoP" required size="5" maxlength="5" pattern="[0-9]{5}"
                                placeholder="<?php echo $literales['codigo postal'] ?>">
                    </div>
                    <div  style="align-items: center" class="form-group">
                        <label for="ciudad"><?php echo $literales['ciudad'] ?></label>
                        <input  type="text" class="form-control" id="ciudad" name="ciudad" required
                                pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                                placeholder="<?php echo $literales['ciudad'] ?>">
                    </div>
                    <div class="form-group">
                    <label for="provincia"><?php echo $literales['provincia'] ?></label>
                    <input  type="text" class="form-control" id="provincia" name="provincia" required
                            pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}"
                            placeholder="<?php echo $literales['provincia'] ?>">
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