<?php
include 'clases/menu.php';

$menu = new Menu("", "", $_SESSION['perfil']);
$stmt = $menu->cargaMenuPorPerfil();
while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
 extract($fila);
    if ($destino_menu != 'javascript:;') {
        echo "<li><a href=\"{$destino_menu} \">{$nombre_menu}</a></li>";
    } else {
        echo "<li><a href=\"{$destino_menu}\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">{$nombre_menu}<b class=\"caret\"></b></a>
        <ul class=\"dropdown-menu\">";
        echo "<li><a href=\"gestionar{$nombre_menu}.php \">Editar</a></li>";
        echo "<li><a href=\"crear{$nombre_menu}.php \">Nuevo</a></li>";
        echo "</ul></li>";
    }
} 