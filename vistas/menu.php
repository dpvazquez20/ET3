
<nav style="padding-left: 24px" class="navbar navbar-inverse sidebar" role="navigation">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="#">Menu</a>
         </div>

         <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
             <ul class="nav navbar-nav">
                <?php
                    require_once('../conectarBD.php');
                    $conexion= conectarBD();
                    $perfilUsuario=$_SESSION['perfil'];
                    $sqlPermisos = "SELECT * from permisos WHERE perfil='$perfilUsuario'";
                    $resul= $conexion->query($sqlPermisos);
                    $arrayPerfilesIntroducidos = array();
                    $existePerfil=false;
                if($resul->num_rows>0){
                    while($row=mysqli_fetch_assoc($resul)) {
                        $existePerfil=false;
                if (in_array($row['controlador'], $arrayPerfilesIntroducidos)) {
                    $existePerfil = true;
                }
                ?>


                 <div class="nav">
                     <?php

                     if ($existePerfil == false) {

                         array_push($arrayPerfilesIntroducidos, $row['controlador']);

                         echo "<li><a class='btn btn-default' href='../controladores/" . $row['controlador'] . "_Controller.php?id=SHOWALL" . $row['controlador'] . "&ctr=" . $row['controlador'] . "'>
                                " . $literales['gestion'] . " " . $row['controlador'] . "</a></li><p></p>";

                     }
                     }
                }?>
                        </div>
             </ul>
         </div>
        </nav>

