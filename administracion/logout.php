<?php

// echo "boca";
try {
    session_start();
    session_unset();
    session_destroy();
    // echo json_encode(['success' => true]);
    // Redireccionar a otra página después de 5 segundos
    header("refresh:5;url=../index.php");

    // También puedes usar la función header directamente
    // header("Location: otra_pagina.php");

    echo "Se cerró correctamente la sesion. Serás redireccionado a otra página en 5 segundos. Si no, puedes hacer clic <a href='../index.php'>aquí</a>.";
} catch (Exception $e) {
    echo json_encode(['success' => false]);
}
