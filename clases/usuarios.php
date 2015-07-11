<?php
class Usuarios {

    private $nidusuario;
    private $susuario;
    private $sclave;
    private $snombre;
    private $sapellido;
    private $semail;
    private $nedad;
    private $nperfil;
    private $fnacimiento;
    private $tabla = "usuarios";

    function __construct($nidu = NULL, $susr = NULL, $sclave = NULL, $snom = NULL, $sape = NULL, $semail = NULL, $ned = NULL, $nper = NULL, $fnacim = NULL) {
        $this->nidusuario = $nidu;
        $this->susuario = $susr;
        $this->sclave = md5($sclave);
        $this->snombre = $snom;
        $this->sapellido = $sape;
        $this->semail = $semail;
        $this->nedad = $ned;
        $this->nperfil = $nper;
        $this->fnacimiento = $fnacim;
    }

    function ide() {
        return $this->nidusuario;
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

    function edad() {
        return $this->sedad;
    }

    function fecha_nacimiento() {
        return $this->fnacimiento;
    }

    function verificaAdministrador() {
        $db = dbconnect();
        $query = 'select nombre_usuario from ' . $this->tabla . ' where login_usuario:=usr and id_perfil = 1';
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
        $query = 'select nombre_usuario from ' . $this->tabla . ' where login_usuario=:usr and pass_usuario=:pwd';
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
        $query = 'SELECT nombre_usuario, apellido_usuario, id_perfil FROM ' . $this->tabla . ' where login_usuario=:usr and pass_usuario=:pwd';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->susuario);
        $stmt->bindParam(':pwd', $this->sclave);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre = $fila['nombre_usuario'];
        $this->sapellido = $fila['apellido_usuario'];
        $this->nperfil = $fila['id_perfil'];
    }

    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT nombre_usuario, apellido_usuario, correo_usuario, login_usuario, pass_usuario, id_perfil, edad_usuario, fechanacimiento_usuario FROM " . $this->tabla . " WHERE id_usuario= ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idadministrador);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre = $fila['nombre_usuario'];
        $this->sapellido = $fila['apellido_usuario'];
        $this->semail = $fila['correo_usuario'];
        $this->susuario = $fila['login_usuario'];
        $this->sclave = $fila['pass_usuario'];
        $this->nperfil = $fila['id_perfil'];
        $this->nedad = $fila['edad_usuario'];
        $this->fnacimiento = $fila['fechanacimiento_usuario'];
    }

    function leer() {
        $db = dbconnect();
        $query = "SELECT id_usuario, nombre_usuario, apellido_usuario, correo_usuario, login_usuario, pass_usuario, id__perfil, edad_usuario, fechanacimiento_usuario FROM " . $this->tabla;
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }

    function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, login_usuario =?, pass_usuario = ? , id_perfil =?, edad_usuario=?, fechanacimiento_usuario=?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre_usuario);
        $this->stmt->bindParam(2, $this->apellido_usuario);
        $this->stmt->bindParam(3, $this->correo_usuario);
        $this->stmt->bindParam(4, $this->login_usuario);
        $this->stmt->bindParam(5, $this->pass_usuario);
        $this->stmt->bindParam(6, $this->id_perfil);
        $this->stmt->bindParam(7, $this->edad_usuario);
        $this->stmt->bindParam(8, $this->fechanacimiento_usuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE id_usuario = ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_usuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, login_usuario =?, pass_usuario =?, id_perfil =?, edad_usuario, fechanacimiento_usuario  WHERE id_usuario = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->nombre_usuario);
        $this->stmt->bindParam(2, $this->apellido_usuario);
        $this->stmt->bindParam(3, $this->correo_usuario);
        $this->stmt->bindParam(4, $this->login_usuario);
        $this->stmt->bindParam(5, $this->pass_usuario);
        $this->stmt->bindParam(6, $this->id_perfil);
        $this->stmt->bindParam(7, $this->id_usuario);
        $this->stmt->bindParam(8, $this->edad_usuario);
        $this->stmt->bindParam(9, $this->fechanacimiento_usuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
