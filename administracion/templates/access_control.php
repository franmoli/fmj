<?php
session_start();
if ($_SESSION['logueado'] == 0) header("Location: login.php");;

if ($_SESSION['admin_level'] > 1) {
    $nombre_archivo = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $paginas_permitidas = array("index.php", "crear-competidor.php", "administrar-competidores.php", "editar-competidor.php");
    // echo $nombre_archivo;
    if (!in_array($nombre_archivo, $paginas_permitidas)) {
        header("Location: login.php");
    }
}
