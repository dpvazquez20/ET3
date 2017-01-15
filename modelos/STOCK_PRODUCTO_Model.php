<?php

require('STOCK_PRODUCTO.php');
require_once ('../conectarBD.php');
class Stock_producto_modelo{

    var $mysql2;
    var $stock_producto;
    function __construct()
    {

        $this->mysql2 =conectarBD();
        $this->stock_producto= new Stock_producto();

    }

    function altaStock_producto($producto)
    {

        $this->mysql=conectarBD();
        $sqlProducto= "SELECT * FROM producto WHERE id_producto='".$producto->getIdProducto()."';";
        $resulProducto= $this->mysql->query($sqlProducto);
        $rowProducto= mysqli_fetch_assoc($resulProducto);
        echo $rowProducto['nombre'];

        $sqlElaboracion = "SELECT * FROM elaboracion WHERE nombre_elaboracion='".$rowProducto['nombre']."';";
        $sqlElaboracionResul= $this->mysql->query($sqlElaboracion);
        $rowElaboracion= mysqli_fetch_assoc($sqlElaboracionResul);
        echo $rowElaboracion['id_elaboracion'];

        /* $this->mysql = conectarBD();
         $insertar = "INSERT INTO stock_producto (id_producto,coste,fecha) VALUES('". $producto->getIdProducto() . "','" . $producto->getFecha() . "','". $producto->getCoste() ."');";
         if($this->mysql->query($insertar)){
             return "Se creo el stock correctamente";
         }else{
             return "No se ha podido insertar el stock";
         }
     }
        */
    }

    function deleteStock_producto($idBorrar){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM stock_producto WHERE id='".$idBorrar."';";

        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente el stock";

        }else{
            return"Lo sentimos, no se ha podido eliminar el stock";

        }

    }

    function modifyStock_producto($id,$producto,$coste,$fecha){
        $this->mysql= conectarBD();
            $sql = "UPDATE stock_producto SET id_producto='" . $producto ."',fecha='". $fecha ."',coste='".$coste."'WHERE id='".$id."';";
            echo $sql;
        if($this->mysql->query($sql)){
            return "El stock ha sido modificado correctamente";

        }else{
            return "El stock no ha podido modificarse";
        }
    }


    public static function listarStock()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM stock_producto";
        $resul = $conexion->query($sql);
        return $resul;
    }


    public static function getStock($id){
        $conexion= conectarBD();
        $sql= "SELECT * from stock_producto WHERE id='".$id."';";
        return $conexion->query($sql);
    }


    public static function getAlbaranes(){
        $conexion= conectarBD();
        $sql= "SELECT * FROM albaran ORDER BY id;";
        return $conexion->query($sql);
    }

    public static function getMateriales(){
        $conexion= conectarBD();
        $sql= "SELECT * FROM material ORDER BY nombre;";
        return $conexion->query($sql);
    }

    public static function getProductos(){
        $conexion= conectarBD();
        $sql= "SELECT * FROM producto ORDER BY nombre;";
        return $conexion->query($sql);
    }

    public static function getProducto($id){
        $conexion= conectarBD();
        $sql= "SELECT * FROM producto WHERE id=".$id." ORDER BY nombre;";
        $resul= $conexion->query($sql);
        $row = mysqli_fetch_assoc($resul);
        return $row['nombre'];
    }

    public static function getMaterial($id){
        $conexion= conectarBD();
        $sql= "SELECT * FROM material WHERE id=".$id." ORDER BY nombre;";
        $resul= $conexion->query($sql);
        $row = mysqli_fetch_assoc($resul);
        return $row['nombre'];
    }

    public static function getStockId($id){
        $conexion = conectarBD();
        if ($id == "") {
            $sql = "SELECT * FROM stock_producto;";
        } else {
            $sql = "SELECT * FROM stock_producto WHERE id='".$id."';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getStockMaterial($nombre){
        $conexion = conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM stock_producto;";
        } else {
            $sql2 = "SELECT * FROM producto WHERE nombre LIKE '%".utf8_encode($nombre)."%' AND borrado='0';";
            $resul2 = $conexion->query($sql2);
            $row = mysqli_fetch_assoc($resul2);
            $id=$row['id'];
            $sql = "SELECT * FROM stock_material WHERE id_material='".$id."';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getStockAlbaran($id){
        $conexion = conectarBD();
        if ($id == "") {
            $sql = "SELECT * FROM stock_producto;";
        } else {
            $sql = "SELECT * FROM stock_producto WHERE id_albaran='".$id."';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getStockProducto($nombre){
        $conexion = conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM stock_material;";
        } else {
            $sql2 = "SELECT * FROM producto WHERE nombre LIKE '%".utf8_encode($nombre)."%';";
            $resul2 = $conexion->query($sql2);
            $row = mysqli_fetch_assoc($resul2);
            $id=$row['id'];
            $sql = "SELECT * FROM stock_producto WHERE id_producto='".$id."';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getPorCoste($coste){
        $conexion= conectarBD();
        if($coste == '') {
            $sql = "SELECT * FROM stock_producto;";
        } else{
            $sql = "SELECT * FROM stock_producto WHERE coste='" . $coste . "';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getNombreProducto($nombre){
        $conexion= conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM producto, stock_producto WHERE stock_producto.id_producto = producto.id_producto;";
        } else {
            $sql = "SELECT * from producto, stock_producto WHERE stock_producto.id_producto = producto.id_producto AND nombre LIKE '" . $nombre . "%';";
        }
        return $conexion->query($sql);
    }

    public static function getPorFecha($fecha)
    {

        $conexion = conectarBD();
        if ($fecha == '') {
            $sql = "SELECT * FROM stock_producto;";
        } else {
            $sql = "SELECT * FROM stock_producto WHERE fecha='" . $fecha . "';";
        }

        $resul = $conexion->query($sql);
        return $resul;
        }

}
?>