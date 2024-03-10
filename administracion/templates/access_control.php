<?php
session_start();
if ($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';

if ($_SESSION['admin_level'] > 1) {
    $nombre_archivo = basename($_SERVER['REQUEST_URI']);
    $paginas_permitidas = array("index.php", "crear-competidor.php", "administrar-competidores.php");
    if (!in_array($nombre_archivo, $paginas_permitidas)) {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }
}
