<?php
session_start();
include ("librerias.php");

?>
<!doctype html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title></title>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <div class="container">
            <div class="jumbotron">
                <h2>Bienvenido <?php echo($_SESSION['nombre'].' '.$_SESSION['apellido']); ?></h2>
                <p><br>Este es el sistema de administraci&oacute;n del sitio Privalia. <br>
                    Privalia es una sitio de outlet online de moda.<br><br>
                    Aqu&iacute; encontrar&aacute;s el ingreso, eliminaci&oacute;n o modificaci&oacute;n de <br> 
                    Usuario, Administrador, Producto y Categor&iacute;a. <br><br>
                    Para salir de la administraci&oacute;n, cierre sesi&oacute;n en el bot&oacute;n superior derecho.</p>
            </div>
            <?php 
           /* dumpo($_SESSION);
            
            dumpo(filter_input( INPUT_SERVER, 'nombre', FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE ));
            
            dumpo($_SESSION['nombre']);
            */?>
        </div>
    </body>
</html>