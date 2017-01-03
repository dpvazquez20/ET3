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
            return "Se creo la acción correctamente";
        }else{
            return "No se ha podido insertar";
        } 
    }
    
    function deleteStock_material($idBorrar){

        $this->mysql = conectarBD();
        $sql = "DELETE FROM stock_material WHERE id='".$idBorrar."';";
        
        if($this->mysql->query($sql)){
            return"Se ha eliminado correctamente la acción";

        }else{
            return"Lo sentimos, no se ha podido eliminar la acción";

        }

    }
    
    function modifyStock_material($idB,$id_materialM,$id_albaranM,$id_productoM){
        //$_POST['id_materialM'],$_POST['id_albaranM'], $_POST['id_productoM']
        $prod=$_POST['id_productoM'];
        $this->mysql= conectarBD();
        if($prod=='null'){
            $sql = "UPDATE stock_material SET id_material='" . $id_materialM ."',id_albaran='". $id_albaranM ."',id_producto=NULL WHERE id='".$idB."';";
        }else{
            $sql = "UPDATE stock_material SET id_material='" . $id_materialM ."',id_albaran='". $id_albaranM ."',id_producto='" . $prod . "' WHERE id='".$idB."';";
        }

        if($this->mysql->query($sql)){
            return "El material ha sido modificado correctamente";

        }else{
            return "El material no ha podido modificarse";

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
}



?>