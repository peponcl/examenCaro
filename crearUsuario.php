<?php
session_start();
include ("librerias.php");
include( "modulos/PHPMailer/PHPMailerAutoload.php");
?>

<!doctype html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title><?= TITULOAPP; ?></title>
    </head>
    <body>
        <?php include 'menu.php'; ?>


        <div class="container">
            <h1></h1>
            <h2>Crear Usuario</h2>

            <?php
            if ($_POST) {
                $oUser = new Usuario();
                $oUser->nombre = $_POST['nombre'];
                $oUser->apellido = $_POST['apellido'];
                $oUser->email = $_POST['email'];
                $oUser->usuario = $_POST['usuario'];
                $oUser->clave = md5($_POST['clave']);
                //dumpo($oUser);
                if ($oUser->crear()) {
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Usuario Ingresado";
                    echo "</div>";

                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->Username = 'maur.ojeda@alumnos.duoc.cl';
                    $mail->Password = 'maur.6023';
                    $mail->SetFrom('mauriciojedab@gmail.com', 'Mauricio Ojeda');
                    $mail->Subject = 'Inscripcion en Privalia';
                    $mail->Body = 'Estimado' .$_POST['nombre'] . ' ' .$_POST['apellido'] .' bienvenido a  Privalia';
                    $mail->AddAddress( $_POST['email']);
                    if (!$mail->Send()) {
                        echo 'Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Mensaje enviado!';
                    }
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido posible ingresar el Usuario";
                    echo "</div>";
                }
            }
            ?>

            <form action="crearUsuario.php"  method="post" id="form_usuario">
                <p>Ingrese informaci&oacute;n para un nuevo usuario al sistema, todos los campos son obligatorios.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" class='form-control required text' name="nombre"></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><input type="text" class='form-control required text' name='apellido'></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input type="text" class='form-control required text' name="email"></td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" class='form-control required text' name="usuario"></td>
                    </tr>
                    <tr>
                        <td>Clave</td>
                        <td><input type="text" class='form-control required text' name="clave"></td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Crear">
            </form>
        </div>
        <script>
            /*validacion de campos del usuario*/
            $('#form_usuario').validate({
                messages: {
                    nombre: "Ingrese su nombre",
                    apellido: "Ingrese su apellido",
                    email: "Ingrese su e-mail",
                    usuario: "Ingrese su usuario",
                    clave: "Ingrese su clave"}
            });
        </script>
    </body>
</html>

