<?php

require('FACTURA.php');
require_once ('../conectarBD.php');

Class Factura_Model{
	var $mysql;
    var $factura;

    function __construct()
    {
        $this->mysql =conectarBD();
        $this->factura= new Factura();

    }

    function altaFactura($factura){
    	
       		$insertar= "INSERT INTO factura (id_proveedor,NIF,fecha) VALUES('".$factura->getIdProveedor()."','".$factura->getNIF()."','".$factura->getFecha()."');";
            if($this->mysql->query($insertar)){
           return "Se ha insertado con exito el factura";
       }else{
           return "lo sentimos no se ha podido crear el factura";
       }
        

    }

    function deleteFactura($id){
    	$this->mysql = conectarBD();
    	$sql1 = "DELETE FROM linea_factura WHERE  id_factura='".$id."';";
        $sql2 = "DELETE FROM factura WHERE id='".$id."';";

       if($this->mysql->query($sql1) && $this->mysql->query($sql2) ){
           return "Se ha eliminado con exito el factura";
       }else{
           return "lo sentimos no se ha podido eliminar el factura";
       }
    }

    function updateFactura($id, $factura){

    	$this->mysql = conectarBD();
    	$sql1 = "UPDATE factura SET id_proveedor =".$factura->getIdProveedor()." , NIF ='".$factura->getNIF()."' , fecha ='".$factura->getFecha()."' "."WHERE  id='".$id."';";
     

       if($this->mysql->query($sql1) ){
           return "Se ha modificado con exito el factura";
       }else{
           return "lo sentimos no se ha podido modificar el factura";
       }

    }

    function altaLineaFactura($idFactura, $idAlbaran){

    	$this->mysql = conectarBD();
    	$insertar= "INSERT INTO linea_factura (id_factura,id_albaran) VALUES('".$idFactura."','".$idAlbaran."');";
            if($this->mysql->query($insertar)){
           return "Se ha insertado con exito la linea de factura";
       }else{
           return "lo sentimos no se ha podido crear la linea de factura";
       }

    }

    function editLineaFactura($idLinea, $idFactura, $idAlbaran){
    	$this->mysql = conectarBD();

    	$update= "UPDATE linea_factura SET id_factura =".$idFactura." , id_albaran='".$idAlbaran."' "."WHERE  id='".$idLinea."';";
            if($this->mysql->query($update)){
           return "Se ha modificado con exito la linea de factura";
       }else{
           return "lo sentimos no se ha podido modificar la linea de factura ".$update;
       }


    }

    function deleteLineaFactura($idLinea){
    	$this->mysql = conectarBD();
    	$sql1 = "DELETE FROM linea_factura WHERE  id='".$idLinea."';";

       if($this->mysql->query($sql1) ){
           return "Se ha eliminado con exito la linea del factura";
       }else{
           return "lo sentimos no se ha podido eliminar el factura";
       }

    }

    public static function getFactura($id){
    	$conexion= conectarBD();
        $sql= "SELECT * from factura WHERE id='".$id."';";
        return $conexion->query($sql);
    }

    public static function getLineasFactura($idFactura){
    	$conexion= conectarBD();
        $sql = "SELECT l.id as id_linea, l.id_factura as id_factura, l.id_albaran as id_albaran FROM linea_factura l,factura f where f.id = l.id_factura AND l.id_factura =".$idFactura.";";
        
        $resul = $conexion->query($sql);

        return $resul;
    }


    public static function listar()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM factura order by fecha DESC";
        $resul = $conexion->query($sql);
        return $resul;
    }




    //ZONA DUMMY

    public static function listarProveedores(){
    	$conexion= conectarBD();
        $sql = "SELECT * FROM proveedor";
        $resul = $conexion->query($sql);
        return $resul;
    }


}

?>