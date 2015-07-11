<?php

class perfil {

    private $snombre_perfil;
    private $ncodigo_perfil;
    private $tabla = "perfil";
  
    function __construct($snom, $ncod) {
        $this->snombre_perfil = $snom;
        $this->ncodigo_perfil = $ncod;
    }

     function nombre() {
        return $this->snombre_perfil;
    }
    
     function codigo_perfil() {
        return $this->ncodigo_perfil;
    }
    
    function leer() {
        $query = "SELECT  codigo_perfil , nombre_perfil FROM
                    " . $this->tabla . " ORDER BY nombre_perfil";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function buscaPorId() {
        $query = "SELECT nombre_perfil FROM " . $this->tabla . " WHERE codigo_perfil = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ncodigo_perfil);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre_perfil = $fila['nombre_perfil'];
    }
}
