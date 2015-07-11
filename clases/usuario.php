<?php

class Usuario {

    private $nidusuario;
    private $snombre;
    private $sapellido;
    private $semail;
    private $susuario;
    private $sclave;
    private $tabla = "usuario";

    function __construct($nid = NULL, $snom = NULL, $sape = NULL, $sem = NULL, $susr = NULL, $sclave = NULL) {
        $this->nidusuario = $nid;
        $this->snombre = $snom;
        $this->sapellido = $sape;
        $this->semail = $sem;
        $this->susuario = $susr;
        $this->sclave = $sclave;
    }

    function ide() {
        return $this->nidusuario;
    }

    function nombre() {
        return $this->snombre;
    }

    function email() {
        return $this->semail;
    }

    function apellido() {
        return $this->sapellido;
    }

    function usuario() {
        return $this->susuario;
    }

      function clave() {
        return $this->sclave;
    }

    function VerificaUsuario() {
        $db = dbconnect();
        $sqlsel = "select nombre from " . $this->tabla . " where usuario=:usr";

        $querysel = $db->prepare($sqlsel);

        $querysel->bindParam(':usr', $this->susuario);

        $datos = $querysel->execute();

        if ($querysel->rowcount() == 1)
            return true;
        else
            return false;
    }

    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT nombre ,apellido ,email ,usuario ,clave FROM " . $this->tabla . " WHERE idusuario= ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idusuario);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre = $fila['nombre'];
        $this->sapellido = $fila['apellido'];
        $this->semail = $fila['email'];
        $this->susuario = $fila['usuario'];
        $this->sclave = $fila['clave'];
    }

    function leer() {
        $db = dbconnect();
        $query = "SELECT idusuario, nombre, apellido, email,  usuario, clave FROM " . $this->tabla;
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }

    function crear() {
        $db = dbconnect();
        $query = "INSERT INTO " . $this->tabla . " SET nombre = ?, apellido = ?, email = ?, usuario =? ,clave =?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre);
        $this->stmt->bindParam(2, $this->apellido);
        $this->stmt->bindParam(3, $this->email);
        $this->stmt->bindParam(4, $this->usuario);
        $this->stmt->bindParam(5, $this->clave);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE idusuario = ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idusuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET nombre = ?, apellido = ?, email = ?, usuario =?, clave =? WHERE idusuario = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre);
        $this->stmt->bindParam(2, $this->apellido);
        $this->stmt->bindParam(3, $this->email);
        $this->stmt->bindParam(4, $this->usuario);
        $this->stmt->bindParam(5, $this->clave);
        $this->stmt->bindParam(6, $this->idusuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}



