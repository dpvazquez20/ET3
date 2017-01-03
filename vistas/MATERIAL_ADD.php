<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}


class Material_add
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
                <title><?php echo $literales['addMaterial']; ?></title>
                <div class="alert alert-info"><?php echo $literales['materialADD'] ?> </div>

                <form role="form" action="MATERIAL_Controller.php?id=ADDMATERIAL&ctr=MATERIAL" method="POST">
                    
                    <div class="form-group">
                        <label for="Nombre"><?php echo $literales['materialNombre']; ?></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required
                               placeholder="<?php echo $literales['introNombreMat']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="Descripcion"><?php echo $literales['materialDescripcion']; ?></label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required
                               placeholder="<?php echo $literales['introDescripcionMat']; ?>">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $literales['sumarMaterial']; ?>" type="submit">
                            <a class="btn btn-default" href="MATERIAL_Controller.php?id=SHOWALLMATERIAL&ctr=MATERIAL"><?php echo $literales['cancelarMaterial']; ?></a>
                        </div>

                </form>
            </div>
        </div>

        <?php include_once('pieDePagina.php');
    }
}

?>