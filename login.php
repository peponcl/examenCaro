<?php
session_start();

include ("librerias.php");
$usr = new Administrador("", "", "", "", $_POST['input_usuario'], $_POST['input_clave'], "");

$usr->buscarAdmin();
if ($usr->VerificaAcceso()) {
echo' <script>
	document.location.href="inicio.php";
</script>';
    $_SESSION['logeado'] = true;
    $_SESSION['nombre'] = $usr->Nombre();
    $_SESSION['apellido'] = $usr->Apellido();
    $_SESSION['perfil'] = $usr->perfil();
    die();
} else {
    echo' <script>
	document.location.href="index.php?error=true";
</script>';
}



 
  