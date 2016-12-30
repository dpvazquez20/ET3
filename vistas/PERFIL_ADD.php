<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
//if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],'Secretario')==0){

//Crea la clase e instancia la función render en el constructor.
class Perfil_add{

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
                <div class="alert alert-info"><?php echo $literales['perfilADD']?> </div>

                <form role="form" action="PERFIL_Controller.php?id=ADDPERFIL&ctr=PERFIL" method="POST">
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input  type="text" class="form-control" id="nombre" name="nombre" required
                                placeholder="Introduce nombre del controlador">
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"><input class="btn btn-primary"value="Enviar" type="submit">
                            <a class="btn btn-default" href="PERFIL_Controller.php?id=SHOWALLPERFIL&ctr=PERFIL";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
/*}else
    echo "Permiso denegado.";
*/
?>