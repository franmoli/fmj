<nav id="sidebar">
    <div class="text-center">
        <!-- Boton de activacion -->
        <i id="boton-sidebar" class="fas fa-align-justify"></i>

        <hr>
        <!-- Opciones de navegación -->
        <div class="categorias" style="display:none;">
            <div class="categoria text-center">
                <h2 class="light-overlay"><i class="fas fa-male"></i>Competidores</h2>
                <a href="crear-competidor.php"><i class="fas fa-plus-circle"></i>Nuevo</a>
                <br>
                <a href="administrar-competidores.php"><i class="fas fa-edit"></i>Administrar</a>
            </div>

            <br>
            <?php if ($_SESSION['admin_level'] <= 1) : ?>
                <div class="categoria text-center">
                    <h2 class="light-overlay"><i class="fas fa-trophy"></i>Torneos</h2>
                    <a href="crear-torneo.php"><i class="fas fa-plus-circle"></i>Nuevo</a>
                    <br>
                    <a href="administrar-torneos.php"><i class="fas fa-edit"></i>Administrar</a>
                </div>

                <br>

                <div class="categoria text-center">
                    <h2 class="light-overlay"><i class="fas fa-graduation-cap"></i>Profesores</h2>
                    <a href="crear-profesor.php"><i class="fas fa-plus-circle"></i>Nuevo</a>
                    <br>
                    <a href="administrar-profesores.php"><i class="fas fa-edit"></i>Administrar</a>
                </div>

                <br>
            <?php endif; ?>
            <div class="categoria text-center">
                <h2 class="light-overlay"><a href="./logout.php"><i class="fas fa-arrow-circle-left"></i>Volver al sitio</a></h2>
            </div>
        </div>
    </div>
</nav>