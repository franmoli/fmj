<?php
$accion = $_POST['accion'];
require('../conexion.php');

if ($accion == "crear") {
    //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo

    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $club = mysqli_real_escape_string($con, $_POST['club']);
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
    //Intento hacer la operación en la base de datos
    try {

        $sql = "INSERT INTO profesores (profesor_password, profesor_email, profesor_usuario, profesor_nombre, profesor_club) VALUES ('$hashed_password', '$email', '$usuario', '$nombre', '$club')";
        $con->query($sql);

        // echo $sql;


        if ($con->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'profesor_creado',
                'nombre' => $nombre,
                'apellido' => $apellido
            );
        } else {
            $respuesta = array(
                'respuesta' => 'profesor_fallido', 'error' => $con->error
            );
        }

        // $stmt->close();
        $con->close();
    } catch (Exception $e) {
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
} else if ($accion == "editar") {
    //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $club = mysqli_real_escape_string($con, $_POST['club']);
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    if ($pass != '') {

        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
        $pass = "profesor_password = '$hashedPassword',";
    }
    //Intento hacer la operación en la base de datos

    try {

        $query = $con->query("UPDATE profesores SET $pass profesor_email = $email, profesor_usuario = $usuario, profesor_nombre = $nombre, profesor_club = $club WHERE profesor_id = ?");
        // $stmt->bind_param('sssssi', $nombre, $email, $club, $usuario, $pass, $telefono, $federacion, $club, $peso, $categoria, $id);

        // $stmt->execute();

        if ($query === TRUE) {
            $respuesta = array(
                'respuesta' => 'profesor_actualizado',
                'nombre' => $nombre
            );
        } else {
            $respuesta = array(
                'respuesta' => 'profesor_fallido',
                'archivo' => $_FILES['foto']
            );
        }

        $stmt->close();
        $con->close();
    } catch (Exception $e) {
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
} else if ($accion == "eliminar") {
    //Paso el ID del usuario
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    //Intento hacer la operación en la base de datos
    try {
        $stmt = $con->prepare('DELETE FROM profesores WHERE profesor_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $respuesta = array(
            'respuesta' => 'profesor_eliminado'
        );

        $stmt->close();
        $con->close();
    } catch (Exception $e) {
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
} else if ($accion == "sumar-puntos") {
    //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $torneo = filter_var($_POST['torneo'], FILTER_SANITIZE_NUMBER_INT);
    $puntosSenior = filter_var($_POST['puntos-senior'], FILTER_SANITIZE_NUMBER_INT);
    $puntosCadete = filter_var($_POST['puntos-cadete'], FILTER_SANITIZE_NUMBER_INT);
    $puntosKyuGraduado = filter_var($_POST['puntos-kyu-graduado'], FILTER_SANITIZE_NUMBER_INT);
    $puntosKyuNovicio = filter_var($_POST['puntos-kyu-novicio'], FILTER_SANITIZE_NUMBER_INT);
    $puntosInfantilB = filter_var($_POST['puntos-infantil-b'], FILTER_SANITIZE_NUMBER_INT);
    $puntosJunior = filter_var($_POST['puntos-junior'], FILTER_SANITIZE_NUMBER_INT);
    //Intento hacer la operación en la base de datos
    try {
        $cargarExistente = " SELECT * FROM `puntos-competidor` WHERE torneo = $torneo AND usuario = $id ";
        $resultadoBD = $con->query($cargarExistente);
        $informacionUsuario = $resultadoBD->fetch_assoc();
        $tieneDatos = $informacionUsuario ? 1 : 0;
        if ($tieneDatos) {
            $puntosSenior = $puntosSenior + $informacionUsuario['puntos_senior'];
            $puntosCadete = $puntosCadete + $informacionUsuario['puntos_cadete'];
            $puntosKyuGraduado = $puntosKyuGraduado + $informacionUsuario['puntos_kyu_graduado'];
            $puntosKyuNovicio = $puntosKyuNovicio + $informacionUsuario['puntos_kyu_novicio'];
            $puntosInfantilB = $puntosInfantilB + $informacionUsuario['puntos_infantil_b'];
            $puntosJunior = $puntosJunior + $informacionUsuario['puntos_junior'];

            $stmt = $con->prepare(" UPDATE `puntos-competidor` SET puntos_senior = ?, puntos_cadete = ?, puntos_kyu_graduado = ?, puntos_kyu_novicio = ?, puntos_infantil_b = ?, puntos_junior = ? WHERE torneo = $torneo AND usuario = $id ");
            $stmt->bind_param('iiiiii', $puntosSenior, $puntosCadete, $puntosKyuGraduado, $puntosKyuNovicio, $puntosInfantilB, $puntosJunior);
            $stmt->execute();
        } else {
            $stmt = $con->query("INSERT INTO `puntos-competidor` (torneo, usuario, puntos_senior, puntos_cadete, puntos_kyu_graduado, puntos_kyu_novicio, puntos_infantil_b, puntos_junior) VALUES ($torneo, $id, $puntosSenior, $puntosCadete, $puntosKyuGraduado, $puntosKyuNovicio, $puntosInfantilB,$puntosJunior)");
        }

        if ($stmt === true || $stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'puntos_actualizados',
            );
        } else {
            $respuesta = array(
                'respuesta' => 'puntos_fallidos',
            );
        }

        $con->close();
    } catch (Exception $e) {
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
}

echo json_encode($respuesta);
