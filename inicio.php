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
                <td>Fecha y Hora:<input type='datetime'></td>
                <h2>Bienvenido <?php echo($_SESSION['nombre'].' '.$_SESSION['apellido']); ?></h2>
                <p><br>Este es el sistema de la importadora "Lo Tenemos Todo". <br>
           </div>
            <?php 
           /* dumpo($_SESSION);
            
            dumpo(filter_input( INPUT_SERVER, 'nombre', FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE ));
            
            dumpo($_SESSION['nombre']);
            */?>
        </div>
    </body>
</html>