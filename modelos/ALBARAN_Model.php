<?php

require('ALBARAN.php');
require_once ('../conectarBD.php');

Class Albaran_Model{
	var $mysql;
    var $albaran;

    function __construct()
    {
        $this->mysql =conectarBD();
        $this->albaran= new Albaran();

    }

    function altaAlbaran($albaran){
    	
       		$insertar= "INSERT INTO albaran (id_pedido,fecha) VALUES('".$albaran->getIdPedido()."','".$albaran->getFecha()."');";
            if($this->mysql->query($insertar)){
           return "Se ha insertado con exito el albaran";
       }else{
           return "lo sentimos no se ha podido crear el albaran";
       }
        

    }

    function deleteAlbaran($id){
    	$this->mysql = conectarBD();
    	$sql1 = "DELETE FROM linea_albaran WHERE  id_albaran='".$id."';";
        $sql2 = "DELETE FROM albaran WHERE id='".$id."';";

       if($this->mysql->query($sql1) && $this->mysql->query($sql2) ){
           return "Se ha eliminado con exito el albaran";
       }else{
           return "lo sentimos no se ha podido eliminar el albaran";
       }
    }

    function updateAlbaran($id, $albaran){

    	$this->mysql = conectarBD();
    	$sql1 = "UPDATE albaran SET id_pedido =".$albaran->getIdPedido()." , fecha ='".$albaran->getFecha()."' "."WHERE  id='".$id."';";
     

       if($this->mysql->query($sql1) ){
           return "Se ha modificado con exito el albaran";
       }else{
           return "lo sentimos no se ha podido modificar el albaran";
       }

    }

    function altaLineaAlbaran($idAlbaran, $idMaterial, $cantidad){

    	$this->mysql = conectarBD();
    	$insertar= "INSERT INTO linea_albaran (id_albaran,id_material,cantidad) VALUES('".$idAlbaran."','".$idMaterial."','".$cantidad."');";
            if($this->mysql->query($insertar)){
           return "Se ha insertado con exito la linea de albaran";
       }else{
           return "lo sentimos no se ha podido crear la linea de albaran";
       }

    }

    function editLineaAlbaran($idLinea, $idAlbaran, $idMaterial, $cantidad){
    	$this->mysql = conectarBD();

    	$update= "UPDATE linea_albaran SET id_albaran =".$idAlbaran." , id_material='".$idMaterial."' "." , cantidad='".$cantidad."' "."WHERE  id='".$idLinea."';";
            if($this->mysql->query($update)){
           return "Se ha modificado con exito la linea de albaran";
       }else{
           return "lo sentimos no se ha podido modificar la linea de albaran";
       }


    }

    function deleteLineaAlbaran($idLinea){
    	$this->mysql = conectarBD();
    	$sql1 = "DELETE FROM linea_albaran WHERE  id='".$idLinea."';";

       if($this->mysql->query($sql1) ){
           return "Se ha eliminado con exito la linea del albaran";
       }else{
           return "lo sentimos no se ha podido eliminar el albaran";
       }

    }

    static function getAlbaranesById($id){
      $conexion = conectarBD();
        if ($id == "") {
            $sql = "SELECT * FROM albaran ";
        } else {
            $sql = "SELECT * FROM albaran WHERE id LIKE '".$id."%';";
        }

        $resul = $conexion->query($sql);
        return $resul;

    }

    static function getAlbaranesByFecha($fecha){
      $conexion = conectarBD();
        if ($fecha == "") {
            $sql = "SELECT * FROM albaran ";
        } else {
            $sql = "SELECT * FROM albaran WHERE fecha LIKE '".$fecha."%';";
        }

        $resul = $conexion->query($sql);
        return $resul;

    }

    public static function getAlbaran($id){
    	$conexion= conectarBD();
        $sql= "SELECT * from albaran WHERE id='".$id."';";
        return $conexion->query($sql);
    }

    public static function getLineasAlbaran($idAlbaran){
    	$conexion= conectarBD();
        $sql = "SELECT a.id as id_linea, a.id_albaran as id_albaran, a.cantidad as cantidad, m.id as id_material, m.nombre as material_nombre FROM linea_albaran a,material m where m.id = a.id_material AND a.id_albaran =".$idAlbaran.";";
        
        $resul = $conexion->query($sql);

        return $resul;
    }

    public static function getLineaAlbaran($idLinea){
      $conexion= conectarBD();
        $sql= "SELECT * from linea_albaran WHERE id='".$idLinea."';";
        return $conexion->query($sql);

    }


    public static function listar()
    {
        $conexion= conectarBD();
        $sql = "SELECT * FROM albaran order by fecha DESC";
        $resul = $conexion->query($sql);
        return $resul;
    }




    //ZONA DUMMY

    public static function listarPedidos(){
    	$conexion= conectarBD();
        $sql = "SELECT * FROM pedido";
        $resul = $conexion->query($sql);
        return $resul;
    }


    public static function listarMateriales(){
    	$conexion= conectarBD();
        $sql = "SELECT * FROM material";
        $resul = $conexion->query($sql);
        return $resul;
    }
}

?>