<?php
session_start();
if ($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';

require('db/conexion.php');
$idProfesor = $_GET['id'];
$cargarProfesor = " SELECT * FROM profesores WHERE profesor_id = $idProfesor ";
$resultadoBD = $con->query($cargarProfesor);
$profesorObtenido = $resultadoBD->fetch_assoc();

if (!$profesorObtenido) echo '<meta http-equiv="refresh" content="0; url=administrar-profesores.php">';
?>

<!DOCTYPE html>
<html lang="es">
<?php include 'templates/head.php'; ?>

<body id="admin-index">
    <!-- Header -->
    <?php include 'templates/header.php'; ?>
    <div class="row">
        <!-- Sidebar -->
        <?php include 'templates/sidebar.php'; ?>
        <!-- Contenido principal -->
        <main id="contenido-principal" class="text-center">
            <!-- Descripción -->
            <section id="descripcion-nuevo-elemento" class="text-center">
                <h1>EDITAR PROFESOR</h1>
                <p>
                    Deberá rellenar los siguientes campos para poder
                    editar al competidor
                </p>
            </section>

            <hr>
            <!-- Formulario -->
            <section id="formulario-creacion">
                <form id="editar-profesor" class="container text-center" action="#">
                    <h3 class="text-left">INFORMACIÓN PERSONAL</h3>
                    <input type="hidden" name="id-profesor" id="id-profesor" value="<?php echo $profesorObtenido['profesor_id'] ?>">
                    <!-- club -->
                    <div class="club">
                        <div class="row etiqueta">
                            <label for="club" class="col-md-12">CLUB</label>
                        </div>
                        <select id="club" class="text-white text-center" name="club">
                            <option value="club1" <?php echo $profesorObtenido['profesor_club'] == 'club1' ? 'selected' : '' ?>>Club 1</option>
                            <option value="club2" <?php echo $profesorObtenido['profesor_club'] == 'club2' ? 'selected' : '' ?>>Club 2</option>
                            <option value="club3" <?php echo $profesorObtenido['profesor_club'] == 'club3' ? 'selected' : '' ?>>Club 3</option>
                        </select>
                    </div>
                    <!-- Nombre -->
                    <div class="nombre">
                        <input id="nombre-profesor" class="text-white text-center with-error" type="text" placeholder="NOMBRE" value="<?php echo $profesorObtenido['profesor_nombre'] ?>">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Usuario -->
                    <div class="usuario">
                        <input id="usuario-profesor" class="text-white text-center with-error" type="text" placeholder="USUARIO" value="<?php echo $profesorObtenido['profesor_usuario'] ?>">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- password -->
                    <div class="password">
                        <input id="password-profesor" class="text-white text-center with-error" type="text" placeholder="CONTRASEÑA">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                        </small>
                    </div>
                    <!-- Email -->
                    <div class="email">
                        <input id="email-profesor" class="text-white text-center with-error" type="email" placeholder="DIRECCIÓN DE CORREO ELECTRÓNICO" value="<?php echo $profesorObtenido['profesor_email'] ?>">
                        <small>
                            Debe cumplirse el siguiente formato: "direccion@empresa.extensiones"
                        </small>
                    </div>

                    <hr>
                    <!-- Enviar formulario -->
                    <input class="text text-center" type="submit" value="EDITAR">
                </form>
            </section>
        </main>
    </div>
    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>
</body>

<?php include 'templates/scripts.php'; ?>

</html>