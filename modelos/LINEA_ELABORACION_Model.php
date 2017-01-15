<?php

require('LINEA_ELABORACION.php');
require_once ('../conectarBD.php');
class Linea_elaboracion_modelo{

    var $mysql2;
    var $linea_elaboracion;
    function __construct()
    {
        $this->mysql2 =conectarBD();
        $this->linea_elaboracion= new Linea_elaboracion();

    }
    public static function listarLineasElaboracion($idElaboracion){
        $conexion= conectarBD();
        $sql = "SELECT * FROM linea_elaboracion WHERE id_elaboracion='".$idElaboracion."';";
        $resul = $conexion->query($sql);
        return $resul;
    }

    function altaLineaElaboracion($linea_elaboracion)
    {

        $this->mysql= conectarBD();
        $sql="SELECT * FROM linea_elaboracion WHERE id_elaboracion='".$linea_elaboracion->getIdElaboracion()."' AND id_material='".$linea_elaboracion->getIdMaterial()."';";
        $resultado= $this->mysql->query($sql);
        if($resultado->num_rows==0){
            $insertar = "INSERT INTO linea_elaboracion (id_elaboracion,id_material,cantidad) VALUES('" . $linea_elaboracion->getIdElaboracion() . "','" . $linea_elaboracion->getIdMaterial() . "','" . $linea_elaboracion->getCantidad() . "');";

            if ($this->mysql->query($insertar)) {
                return "Se ha creado correctamente la linea de elaboración";

            } else {
                return "Lo sentimos, no se ha podido crear la linea";
            }
        }else{
            return "Lo sentimos, ese material ya esta agregado";
        }

    }

    function deleteLineaElaboracion($id)
    {
        $this->mysql = conectarBD();
        $sql = "DELETE FROM linea_elaboracion WHERE id_linea_elaboracion='" . $id . "';";
        echo $sql;
        if ($this->mysql->query($sql)) {
            return "Se ha eliminado correctamente la linea";
        } else {
            return "Lo sentimos, no se ha podido borrar correctamente la linea";
        }

    }

    function modifyLineaElaboracion($id,$nombre, $cantidad)
    {
        $this->mysql = conectarBD();
        $sql = "UPDATE linea_elaboracion SET id_material='" . $nombre . "',cantidad='" . $cantidad . "' WHERE id_linea_elaboracion='" . $id . "';";
        if ($this->mysql->query($sql)) {
            return "La linea ha sido modificado correctamente";
        } else {
            return "Lo sentimos, no se ha podido modificar la linea";
        }
    }












    function getMaterial($id){
        $conexion= conectarBD();
        $sql= "SELECT * from material WHERE id='".$id."';";
        return $conexion->query($sql);
    }

    public static function getLineaElaboracion($idLinea)
    {
        $conexion = conectarBD();
        $sql = "SELECT * FROM linea_elaboracion WHERE id_linea_elaboracion ='" . $idLinea . "';";
        $resul = $conexion->query($sql);
        return $resul;
    }


}
?>

