<?php

class Productos{
	private $nidproductos;
	private $snombre;
	private $sdescripcion;
        private $sfoto;
        private $ncantidad;
        private $nprecio;
        private $nidcategoria;
        private $tabla = "productos";

	function __construct($nid = NULL, $snom = NULL, $sdescrip = NULL, $sfo = NULL, $ncant = NULL, $npre = NULL, $nidcat = NULL){
		$this->nidproductos=$nid;
                $this->snombre=$snom;
                $this->sdescripcion=$sdescrip;
                $this->sfoto=$sfo;
		$this->ncantidad=$ncant;
		$this->nprecio=$npre;
                $this->nidcategoria=$nidcat;
	}
	
        function ide() {
        return $this->nidproductos;
        }
        function nombre() {
            return $this->snombre;
        }
        function descripcion() {
            return $this->sdescripcion;
        }
        function foto() {
            return $this->sfoto;
        }
        function cantidad() {
            return $this->ncantidad;
        }
        function precio() {
            return $this->nprecio;
        }
        
        function idCategoria() {
            return $this->nidcategoria;
        }
        
	function VerificaProductos(){
		$db=dbconnect();
		$sqlsel="select nombre from productos
		where idproductos=:nid";
                $querysel=$db->prepare($sqlsel);
                $querysel->bindParam(':nid',$this->nidproductos);
                $querysel->execute();
	
                if ($querysel->rowcount()==1){
                    return true; 
                } else{
                     return false;
                }
	}

  
	function leer() {
        $db = dbconnect();
        $query = "SELECT idproductos, nombre, descripcion, foto, cantidad, precio, idcategoria FROM " . $this->tabla . " ORDER BY idproductos";
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
        }
        
        function buscarporId() {
        $db = dbconnect();
        $query = "SELECT idproductos, nombre, descripcion, foto, cantidad, precio, idcategoria FROM " . $this->tabla . " WHERE idproductos = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idproductos);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre = $fila['nombre'];
        $this->sdescripcion = $fila['descripcion'];
        $this->sfoto = $fila['foto'];
        $this->ncantidad = $fila['cantidad'];
        $this->nprecio = $fila['precio'];
        $this->nidcategoria = $fila['idcategoria'];
        }
        
        
        function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET nombre = ?, descripcion = ?, foto = ?, cantidad =?, precio =?, idcategoria =?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre);
        $this->stmt->bindParam(2, $this->descripcion);
        $this->stmt->bindParam(3, $this->foto);
        $this->stmt->bindParam(4, $this->cantidad);
        $this->stmt->bindParam(5, $this->precio);
        $this->stmt->bindParam(6, $this->idcategoria);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
        
        function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET nombre = ?, descripcion = ?, foto = ?, cantidad = ?, precio = ?, idcategoria =?  WHERE idproductos = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre);
        $this->stmt->bindParam(2, $this->descripcion);
        $this->stmt->bindParam(3, $this->foto);
        $this->stmt->bindParam(4, $this->cantidad);
        $this->stmt->bindParam(5, $this->precio);
        $this->stmt->bindParam(6, $this->idproductos);
        $this->stmt->bindParam(7, $this->idcategoria);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
            }
        }
        
        function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE idproductos = ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idproductos);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
            }
        }       
}



