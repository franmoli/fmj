<?php

$accion = $_POST['accion'];
require('../conexion.php');

if ($accion == "crear") {
    //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $categorias = filter_var($_POST['categorias'], FILTER_SANITIZE_STRING);
    $inscripcion = filter_var($_POST['inscripcion'], FILTER_SANITIZE_NUMBER_INT);
    $urlImagen = "";
    $urlReglas = "";
    $urlResultados = "";

    //Intento hacer la operación en la base de datos
    try {
        if ($_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg') {
            //Obtengo el tipo de archivo
            $separadorTipo = strpos($_FILES['imagen']['type'], '/');
            $extensionArchivo = substr($_FILES['imagen']['type'], $separadorTipo + 1);
            //Configuro el directorio y la muevo
            $directorio = '../../../img/Torneos/';
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre . '.' . $extensionArchivo)) {
                $urlImagen = "img/Torneos/" . $nombre . '.' . $extensionArchivo;
            } else {
                throw new Exception("No se pudo subir el archivo");
            }
        }
        if ($_FILES['reglas']['type'] == 'application/pdf' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            //Obtengo el tipo de archivo
            if ($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $extensionArchivo = "docx";
            } else {
                if ($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                    $extensionArchivo = "xlsx";
                } else {
                    $separadorTipo = strpos($_FILES['reglas']['type'], '/');
                    $extensionArchivo = substr($_FILES['reglas']['type'], $separadorTipo + 1);
                }
            }
            //Configuro el directorio y la muevo
            $directorio = '../../../reglas/';
            if (move_uploaded_file($_FILES['reglas']['tmp_name'], $directorio . $nombre . '.' . $extensionArchivo)) {
                $urlReglas = "reglas/" . $nombre . '.' . $extensionArchivo;
            } else {
                throw new Exception("No se pudo subir el archivo");
            }
        }
        if ($_FILES['resultados']['type'] == 'application/pdf' || $_FILES['resultados']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $_FILES['resultados']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            //Obtengo el tipo de archivo
            if ($_FILES['resultados']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $extensionArchivo = "docx";
            } else {
                if ($_FILES['resultados']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                    $extensionArchivo = "xlsx";
                } else {
                    $separadorTipo = strpos($_FILES['resultados']['type'], '/');
                    $extensionArchivo = substr($_FILES['resultados']['type'], $separadorTipo + 1);
                }
            }
            //Configuro el directorio y la muevo
            $directorio = '../../../resultados/';
            if (move_uploaded_file(
                $_FILES['resultados']['tmp_name'],
                $directorio . $nombre . '.' . $extensionArchivo
            )) {
                $urlResultados = "resultados/" . $nombre . '.' . $extensionArchivo;
            } else {
                throw new Exception("No se pudo subir el archivo");
            }
        }
        $stmt = $con->prepare(
            'INSERT INTO torneos (nombre, categorias, reglas, imagen, resultados, inscripcion) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssssi', $nombre, $categorias, $urlReglas, $urlImagen, $urlResultados, $inscripcion);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'torneo_creado',
                'nombre' => $nombre
            );
        } else {
            $respuesta = array(
                'respuesta' => 'torneo_fallido'
            );
        }

        $stmt->close();
        $con->close();
    } catch (Exception $e) {
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
} else {
    if ($accion == "editar") {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $categorias = filter_var($_POST['categorias'], FILTER_SANITIZE_STRING);
        $inscripcion = filter_var($_POST['inscripcion'], FILTER_SANITIZE_NUMBER_INT);

        // Inicializo los campos a actualizar
        $campos = ['nombre = ?', 'categorias = ?', 'inscripcion = ?'];
        $valores = [$nombre, $categorias, $inscripcion];
        $tipos = 'ssi';

        // Procesar imagen si fue subida
        if (!empty($_FILES['imagen']['name']) && in_array(
                $_FILES['imagen']['type'],
                ['image/png', 'image/jpg', 'image/jpeg']
            )) {
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $rutaDestino = '../../../img/Torneos/' . $nombre . '.' . $extension;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                $urlImagen = 'img/Torneos/' . $nombre . '.' . $extension;
                $campos[] = 'imagen = ?';
                $valores[] = $urlImagen;
                $tipos .= 's';
            }
        }

        // Procesar reglas si fue subida
        if (!empty($_FILES['reglas']['name'])) {
            $mime = $_FILES['reglas']['type'];
            $extensionesPermitidas = [
                'application/pdf' => 'pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx'
            ];

            if (isset($extensionesPermitidas[$mime])) {
                $extension = $extensionesPermitidas[$mime];
                $rutaDestino = '../../../reglas/' . $nombre . '.' . $extension;
                if (move_uploaded_file($_FILES['reglas']['tmp_name'], $rutaDestino)) {
                    $urlReglas = 'reglas/' . $nombre . '.' . $extension;
                    $campos[] = 'reglas = ?';
                    $valores[] = $urlReglas;
                    $tipos .= 's';
                }
            }
        }


        // Procesar resultados si fue subida
        if (!empty($_FILES['resultados']['name'])) {
            $mime = $_FILES['resultados']['type'];
            $extensionesPermitidas = [
                'application/pdf' => 'pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx'
            ];

            if (isset($extensionesPermitidas[$mime])) {
                $extension = $extensionesPermitidas[$mime];
                $rutaDestino = '../../../resultados/' . $nombre . '.' . $extension;
                if (move_uploaded_file($_FILES['resultados']['tmp_name'], $rutaDestino)) {
                    $urlReglas = 'resultados/' . $nombre . '.' . $extension;
                    $campos[] = 'resultados = ?';
                    $valores[] = $urlReglas;
                    $tipos .= 's';
                }
            }
        }

//        // Agrego el ID
//        $valores[] = $id;
//        $tipos .= 'i';

        // Construyo consulta dinámica
        $sql = 'UPDATE torneos SET ' . implode(', ', $campos) . ' WHERE id = ?';

        try {
            $stmt = $con->prepare($sql);
            $stmt->bind_param($tipos, ...$valores);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $respuesta = [
                    'respuesta' => 'torneo_actualizado',
                    'nombre' => $nombre
                ];
            } else {
                $respuesta = [
                    'respuesta' => 'torneo_fallido'
                ];
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            $respuesta = [
                'respuesta' => 'error',
                'mensaje' => $e->getMessage()
            ];
        }
    } else {
        if ($accion == "eliminar") {
            //Paso el ID del usuario
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            //Intento hacer la operación en la base de datos
            try {
                $stmt = $con->prepare('DELETE FROM `fechas-torneo` WHERE torneo = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();


                $stmt = $con->prepare('DELETE FROM torneos WHERE id = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $respuesta = array(
                    'respuesta' => 'torneo_eliminado'
                );
                $stmt->close();
                $con->close();
            } catch (Exception $e) {
                $respuesta = array(
                    'error' => $e->getMessage()
                );
            }
        } else {
            if ($accion == "nueva-fecha") {
                //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
                $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                $fecha = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
                $hora = filter_var($_POST['hora'], FILTER_SANITIZE_STRING);
                $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
                //Intento hacer la operación en la base de datos
                try {
                    $stmt = $con->prepare(
                        'INSERT INTO `fechas-torneo` (torneo, fecha, hora, direccion) VALUES (?, ?, ?, ?)'
                    );
                    $stmt->bind_param('isss', $id, $fecha, $hora, $direccion);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $respuesta = array(
                            'respuesta' => 'fecha_añadida',
                        );
                    } else {
                        $respuesta = array(
                            'respuesta' => 'fecha_fallida',
                        );
                    }

                    $stmt->close();
                    $con->close();
                } catch (Exception $e) {
                    $respuesta = array(
                        'error' => $e->getMessage()
                    );
                }
            }
        }
    }
}

echo json_encode($respuesta);
?>