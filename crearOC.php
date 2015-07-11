<?php
session_start();
include ("librerias.php");

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
            <h2>Ingreso de Orden de Compra</h2>

            <?php
            if ($_POST) {
                $target_path = $_SERVER['DOCUMENT_ROOT']."/importadora/files/orden_compra/";
                $target_path = $target_path . basename($_FILES['foto']['name']);
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
                    true;
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido posible subir la foto del Producto";
                    echo "</div>";
                }
 /* MODIFICAR  $oProd = new productos();
                $oProd->nombre = $_POST['nombre'];
                $oProd->descripcion = $_POST['descripcion'];
                $oProd->foto = $target_path;
                $oProd->cantidad = $_POST['cantidad'];
                $oProd->precio = $_POST['precio'];
                $oProd->idcategoria = $_POST['idcategoria'];  */
                if ($oProd->crear()) {
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Producto Ingresado";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido posible ingresar el Producto";
                    echo "</div>";
                }
            }
            ?>
            <form enctype="multipart/form-data" action="crearOC.php"  method="post" id="form_oc">
                <p>Ingrese informaci&oacute;n para la creaci&oacute;n de una Orden de Compra.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" class='form-control required text' name="nombre"></td>
                    </tr>
                    <tr>
                        <td>Descripci&oacute;n</td>
                        <td><input type="text" class='form-control required text' name='descripcion'></td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td><input type="file" class='form-control required file' name="foto" id="foto"></td>
                    </tr>
                    <tr>
                        <td>Cantidad</td>
                        <td><input type="text" class='form-control required text' name="cantidad"></td>
                    </tr>
                    <tr>
                        <td>Precio</td>
                        <td><input type="text" class='form-control required text' name="precio"></td>
                    </tr>
                    <tr>
                        <td>Categor&iacute;a</td>
                        <td>
                            <?php
                            $oCat = new Categoria();
                            $stmt = $oCat->leer();
                            echo '<select class="form-control" name="idcategoria">';
                            echo '<option>Seleccione...</option>';
                            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($fila);
                                echo "<option value='{$idcategorias}'>{$nombre}</option>";
                            }
                            echo'</select>';
                            ?>
                        </td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Crear">
            </form>
        </div>
        <script>
            /*validacion de campos del producto*/
            $('#form_producto').validate({
                messages: {
                    nombre: "Ingrese el nombre del producto",
                    descripcion: "Ingrese la descripci&oacute;n",
                    foto: "Seleccione una foto para cargar",
                    cantidad: "Ingresa la cantidad de productos que hay en stock",
                    precio: "Ingrese el precio del producto"}
            });
        </script>
    </body>
</html>

