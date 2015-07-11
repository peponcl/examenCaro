<?php
class Administrador {

    private $nidadministrador;
    private $snombre;
    private $sapellido;
    private $semail;
    private $susuario;
    private $sclave;
    private $nperfil;
    private $tabla = "administrador";

    function __construct($nida = NULL, $snom = NULL, $sape = NULL, $semail = NULL, $susr = NULL, $sclave = NULL, $nper = NULL) {
        $this->nidadministrador = $nida;
        $this->snombre = $snom;
        $this->sapellido = $sape;
        $this->semail = $semail;
        $this->susuario = $susr;
        $this->sclave = md5($sclave);
        $this->nperfil = $nper;
    }

    function ide() {
        return $this->nidadministrador;
    }

    function nombre() {
        return $this->snombre;
    }

    function apellido() {
        return $this->sapellido;
    }

    function email() {
        return $this->semail;
    }

    function usuario() {
        return $this->susuario;
    }

    function clave() {
        return $this->sclave;
    }

    function perfil() {
        return $this->nperfil;
    }

    function verificaAdministrador() {
        $db = dbconnect();
        $query = 'select nombre from ' . $this->tabla . ' where usuario:=usr';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->susuario);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function VerificaAcceso() {
        $db = dbconnect();
        $query = 'select nombre from ' . $this->tabla . ' where usuario=:usr and clave=:pwd';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->susuario);
        $stmt->bindParam(':pwd', $this->sclave);
        $stmt->execute();
        if ($stmt->rowcount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function buscarAdmin() {
        $db = dbconnect();
        $query = 'SELECT nombre, apellido, codigo_perfil FROM ' . $this->tabla . ' where usuario=:usr and clave=:pwd';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->susuario);
        $stmt->bindParam(':pwd', $this->sclave);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre = $fila['nombre'];
        $this->sapellido = $fila['apellido'];
        $this->nperfil = $fila['codigo_perfil'];
    }

    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT nombre ,apellido ,email ,usuario ,clave ,codigo_perfil FROM " . $this->tabla . " WHERE idadministrador = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idadministrador);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre = $fila['nombre'];
        $this->sapellido = $fila['apellido'];
        $this->semail = $fila['email'];
        $this->susuario = $fila['usuario'];
        $this->sclave = $fila['clave'];
        $this->nperfil = $fila['codigo_perfil'];
    }

    function leer() {
        $db = dbconnect();
        $query = "SELECT idadministrador, nombre ,apellido ,email ,usuario ,clave ,codigo_perfil  FROM " . $this->tabla;
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }

    function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET nombre = ?, apellido = ?, email = ?, usuario =? ,clave =? ,codigo_perfil =?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre);
        $this->stmt->bindParam(2, $this->apellido);
        $this->stmt->bindParam(3, $this->email);
        $this->stmt->bindParam(4, $this->usuario);
        $this->stmt->bindParam(5, $this->clave);
        $this->stmt->bindParam(6, $this->codigo_perfil);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE idadministrador = ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idadministrador);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET nombre = ?, apellido = ?, email = ?, usuario =? ,clave =? ,codigo_perfil =?  WHERE idadministrador = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre);
        $this->stmt->bindParam(2, $this->apellido);
        $this->stmt->bindParam(3, $this->email);
        $this->stmt->bindParam(4, $this->usuario);
        $this->stmt->bindParam(5, $this->clave);
        $this->stmt->bindParam(6, $this->codigo_perfil);
        $this->stmt->bindParam(7, $this->idadministrador);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
