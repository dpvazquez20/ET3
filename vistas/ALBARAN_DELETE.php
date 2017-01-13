<?php

if(!isset($_SESSION)){
    session_start();
}
class Albaran_delete{

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

                <title> <?php echo $literales['borrarAlbaran'] ?></title>
                <?php $resul = Albaran_Model::getAlbaran($_GET['idAlbaran']);
                $row= mysqli_fetch_assoc($resul);
                ?>
                <script type="text/javascript">
                    function borrar() {
                        var mensaje = confirm("¿Estas seguro que deseas borrar el albaran?");
                        if(mensaje){
                            alert("Quieres borrarlo");
                        }else{
                            alert("No estas tan seguro no?")
                        }
                        }


                </script>
                <div class="alert alert-danger"> <?php echo $literales['albaranDELETE'] ?></div>
                <form role="form" action="ALBARAN_Controller.php?id=DELETEALBARAN&ctr=ALBARAN" method="POST">
                    <div class="form-group">
                      

                        <label for="id_albaran"><?php echo $literales['idAlbaran'] ?></label>
                        <input  type="text" class="form-control" id="id_albaran" name="id_albaran" readonly="readonly"
                                value="<?php  echo $row['id']?>">
                    </div>
                     <div class="form-group">
                        <label for="accionB"><?php echo $literales['idPedido'] ?></label>
                        <input  type="text" class="form-control" id="id_pedido" name="id_pedido" readonly="readonly"
                                value="<?php  echo $row['id_pedido']?>">
                    </div>
                    <div class="form-group">
                        <label for="perfilB"><?php echo $literales['fecha'] ?></label>
                        <input  type="text" class="form-control" id="fecha" name="fecha" readonly="readonly"
                                value="<?php  echo $row['fecha']?>">
                    </div>

                    <div class="form-group">
                            <input id ="borrar" name="borrar"class="btn btn-danger"value="<?php echo $literales['eliminar']?>"type="submit">
                            <a class="btn btn-default" href="ALBARAN_Controller.php?id=SHOWALLALBARAN&ctr=ALBARAN";">&laquo; <?php echo $literales['cancelar'];?></a>
                    </div>

                </form>
            </div>
            </div>
        </div>

        <?php include_once ('pieDePagina.php');
    }
}
?>