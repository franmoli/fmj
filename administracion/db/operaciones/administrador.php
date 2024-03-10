<?php
$accion = $_POST['accion'];
require('../conexion.php');

if ($accion == "loguear") {
    //Obtengo los datos recibidos de JS filtrandolos para evitar codigo malo
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    //Hago la consulta en la base de datos
    try {
        $cargarUsuario = " SELECT * FROM administradores WHERE usuario = '$usuario' AND  password = PASSWORD('$password') ";
        $resultadoBD = $con->query($cargarUsuario);
        $usuarioObtenido = $resultadoBD->fetch_assoc();

        if ($usuarioObtenido) {
            session_start();
            $_SESSION['logueado'] = 1;
            $_SESSION['usuario'] = $usuario;

            $respuesta = array(
                'respuesta' => 'sesion_iniciada',
                'usuario' => $usuario
            );
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $usuario = strtoupper($usuario);
            $cargarUsuario = " SELECT * FROM profesores WHERE profesor_usuario = '$usuario' ";
            $resultadoBD = $con->query($cargarUsuario);
            $usuarioObtenido = $resultadoBD->fetch_assoc();

            if ($usuarioObtenido) {
                // Verificar la contraseña encriptada usando password_verify()
                if (password_verify($password, $usuarioObtenido['profesor_password'])) {
                    session_start();
                    $_SESSION['logueado'] = 1;
                    $_SESSION['usuario'] = $usuario;
                    $respuesta = array(
                        'respuesta' => 'sesion_iniciada',
                        'usuario' => $usuario
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'sesion_fallida',
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'sesion_fallida',
                );
            }
        }
    } catch (\Exception $e) {
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
}

echo json_encode($respuesta);
