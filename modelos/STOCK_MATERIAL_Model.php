<?php

require('STOCK_MATERIAL.php');
require_once ('../conectarBD.php');
class Stock_material_modelo{

    var $mysql2;
    var $stock_material;
    function __construct()
    {
        
        $this->mysql2 =conectarBD();
        $this->stock_material= new Stock_material();

    }

    function altaStock_material($stockAInsertar){
             
        $this->mysql = conectarBD();
        
        if($stockAInsertar->getId_producto() == 'null'){
            $insertar = "INSERT INTO stock_material (id_material,id_albaran) VALUES('". $stockAInsertar->getId_material() . "','" . $stockAInsertar->getId_albaran() . "');";
        }else{
            $insertar = "INSERT INTO stock_material (id_material,id_albaran,id_producto) VALUES('". $stockAInsertar->getId_material() . "','" . $stockAInsertar->getId_albaran() . "','". $stockAInsertar->getId_producto() ."');";
        }
        if($this->mysql->query($insertar)){
            return "Se creo el stock correctamente";
        }else{
            return "No se ha podido insertar el stock";
        } 
    }
    
    function deleteStock_material($idBorrar){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM stock_material WHERE id='".$idBorrar."';";
        
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente el stock";

        }else{
            return"Lo sentimos, no se ha podido eliminar el stock";

        }

    }
    
    function modifyStock_material($idB,$id_materialM,$id_albaranM,$id_productoM){
        $this->mysql= conectarBD();
        if($id_productoM=='null'){
            $sql = "UPDATE stock_material SET id_material='" . $id_materialM ."',id_albaran='". $id_albaranM ."',id_producto=NULL WHERE id='".$idB."';";
        }else{
            $sql = "UPDATE stock_material SET id_material='" . $id_materialM ."',id_albaran='". $id_albaranM ."',id_producto='" . $id_productoM . "' WHERE id='".$idB."';";
        }

        if($this->mysql->query($sql)){
            return "El stock ha sido modificado correctamente";

        }else{
            return "El stock no ha podido modificarse";

        }
    }

    public static function listarStock()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM stock_material";
        $resul = $conexion->query($sql);
        return $resul;
    }

    public static function getStock($id){
        $conexion= conectarBD();
        $sql= "SELECT * from stock_material WHERE id='".$id."';";
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
        $sql= "SELECT * FROM producto WHERE id_producto=".$id." ORDER BY nombre;";
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
            $sql = "SELECT * FROM stock_material;";
        } else {
            $sql = "SELECT * FROM stock_material WHERE id='".$id."';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }
    
    public static function getStockMaterial($nombre){
        $conexion = conectarBD();
        if ($nombre == "") {
            $sql = "SELECT * FROM stock_material;";
        } else {
            $sql2 = "SELECT * FROM material WHERE nombre LIKE '%".utf8_encode($nombre)."%' AND borrado='0';";
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
            $sql = "SELECT * FROM stock_material;";
        } else {
            $sql = "SELECT * FROM stock_material WHERE id_albaran='".$id."';";
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
            $sql = "SELECT * FROM stock_material WHERE id_producto='".$id."';";
        }
        $resul = $conexion->query($sql);
        return $resul;
    }
}



?>