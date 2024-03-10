<?php
//controlo el acceso sin autorizacion
require('templates/access_control.php');
//Cargo los datos necesarios de la base de datos
require('db/conexion.php');

$cargarProfesores = " SELECT * FROM profesores ORDER BY profesor_nombre ";
$resultadoBD = $con->query($cargarProfesores);
// echo $con->error;
$profesores = array();
while ($profesor = $resultadoBD->fetch_assoc()) {
    array_push($profesores, $profesor);
}
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
            <section id="descripcion-administrar-elemento" class="text-center">
                <h1>ADMINISTRAR PROFESORES</h1>
                <p>
                    Se han encontrado un total de <?php echo count($profesores); ?> profesores creados
                </p>
            </section>

            <hr>
            <!-- Tabla de Torneos -->
            <section id="tabla-de-administracion" class="text-center" style="min-height:55vh; overflow:scroll; width:95%; margin: 0 auto;">
                <table id="tabla-administrar">
                    <thead>
                        <th width="33%">NOMBRE</th>
                        <th width="33%">CLUB</th>
                        <th width="33%">ACCIONES</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($profesores as $profesor) {
                        ?>
                            <tr>
                                <td width="33%"><?php echo $profesor['profesor_nombre']; ?></td>
                                <td width="33%"><?php echo $profesor['profesor_club']; ?></td>
                                <td width="33%">
                                    <a href="editar-profesor.php?id=<?php echo $profesor['profesor_id']; ?>" class="col-md-4 text-warning" title="Editar"><i class="fas fa-pen-square"></i></a>
                                    <a id="eliminar-profesor" data-profesor="<?php echo $profesor['profesor_id']; ?>" href="#eliminar-profesor" class="col-md-4 text-danger" title="Eliminar"><i class="fas fa-minus-square"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>


</body>

<?php include 'templates/scripts.php'; ?>

</html>