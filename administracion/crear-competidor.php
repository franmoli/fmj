<?php
//controlo el acceso sin autorizacion
require('templates/access_control.php'); ?>

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
                <h1>NUEVO COMPETIDOR</h1>
                <p>
                    Deberá rellenar los siguientes campos para poder
                    generar un competidor
                </p>
            </section>

            <hr>
            <!-- Formulario -->
            <section id="formulario-creacion">
                <form id="crear-competidor" class="container text-center" action="#">
                    <h3 class="text-left">INFORMACIÓN PERSONAL</h3>
                    <!-- Categoría -->
                    <div class="categoria">
                        <div class="row etiqueta">
                            <label for="categoria-competidor" class="col-md-12">CATEGORÍA</label>
                        </div>
                        <fieldset id="categoria-competidor" class="radio-button" value="CATEGORÍA">
                            <div class="row">
                                <div class="col-md-4 radio-button">
                                    <input id="categoria-senior" type="radio" value="SENIOR" name="categoria-competidor">
                                    <label for="categoria-senior">
                                        <div class="icono"></div>
                                        <span>SENIOR</span>
                                    </label>
                                </div>
                                <div class="col-md-4 radio-button">
                                    <input id="categoria-cadete" type="radio" value="CADETE" name="categoria-competidor">
                                    <label for="categoria-cadete">
                                        <div class="icono"></div>
                                        <span>CADETE</span>
                                    </label>
                                </div>
                                <div class="col-md-4 radio-button">
                                    <input id="categoria-kyuGraduado" type="radio" value="KYU GRADUADO" name="categoria-competidor">
                                    <label for="categoria-kyuGraduado">
                                        <div class="icono"></div>
                                        <span>KYU GRADUADO</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 radio-button">
                                    <input id="categoria-kyuNovicio" type="radio" value="KYU NOVICIO" name="categoria-competidor">
                                    <label for="categoria-kyuNovicio">
                                        <div class="icono"></div>
                                        <span>KYU NOVICIO</span>
                                    </label>
                                </div>
                                <div class="col-md-4 radio-button">
                                    <input id="categoria-infantilB" type="radio" value="INFANTIL B" name="categoria-competidor">
                                    <label for="categoria-infantilB">
                                        <div class="icono"></div>
                                        <span>INTANTIL B</span>
                                    </label>
                                </div>
                                <div class="col-md-4 radio-button">
                                    <input id="categoria-junior" type="radio" value="JUNIOR" name="categoria-competidor">
                                    <label for="categoria-junior">
                                        <div class="icono"></div>
                                        <span>JUNIOR</span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <br><br>
                    <!-- Nombre -->
                    <div class="nombre">
                        <label for="nombre-competidor" style="color:black; font-size:1.6rem">Nombre del competidor</label>
                        <input id="nombre-competidor" class="text-white text-center with-error" type="text" placeholder="NOMBRE">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Apellido -->
                    <div class="apellido">
                        <label for="apellido-competidor" style="color:black; font-size:1.6rem">Apellido del competidor</label>
                        <input id="apellido-competidor" class="text-white text-center with-error" type="text" placeholder="APELLIDO">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- DNI -->
                    <div class="dni">
                        <label for="dni-competidor" style="color:black; font-size:1.6rem">Dni del competidor</label>
                        <input id="dni-competidor" class="text-white text-center with-error" type="number" placeholder="NÚMERO DE DNI">
                        <small>
                            No deben incluirse puntos ni caracteres especiales, solo números <br>
                        </small>
                    </div>
                    <!-- Email -->
                    <div class="email">
                        <label for="email-competidor" style="color:black; font-size:1.6rem">Email del competidor</label>
                        <input id="email-competidor" class="text-white text-center with-error" type="email" placeholder="DIRECCIÓN DE CORREO ELECTRÓNICO">
                        <small>
                            Debe cumplirse el siguiente formato: "direccion@empresa.extensiones"
                        </small>
                    </div>
                    <!-- Telefono -->
                    <div class="telefono">
                        <label for="telefono-competidor" style="color:black; font-size:1.6rem">Telefono del competidor</label>
                        <input id="telefono-competidor" class="text-white text-center with-error" type="tel" placeholder="NÚMERO DE TELEFONO">
                        <small>
                            Debe cumplirse el siguiente formato: "(AAAA) NNNNNNNN" <br>
                            * AAAA representa el código de area (no deben ser exactamente 4 caracteres) <br>
                            * NNNNNNNN representa el número telefónico (no deben ser exactamente 8 caracteres) <br>
                            * Los parentesis deben ubicarse igual que en el ejemplo <br>
                            * El espacio luego del cierre de parentesis debe respetarse
                        </small>
                    </div>
                    <!-- Género -->
                    <div class="genero">
                        <div class="row etiqueta">
                            <label for="genero-competidor" class="col-md-12">GÉNERO</label>
                        </div>
                        <fieldset id="genero-competidor" class="radio-button" value="GÉNERO">
                            <div class="row">
                                <div class="col-6 radio-button">
                                    <input id="genero-masculino" type="radio" value="MASCULINO" name="genero-competidor">
                                    <label for="genero-masculino">
                                        <div class="icono"></div>
                                        <span>MASCULINO</span>
                                    </label>
                                </div>
                                <div class="col-6 radio-button">
                                    <input id="genero-femenino" type="radio" value="FEMENINO" name="genero-competidor">
                                    <label for="genero-femenino">
                                        <div class="icono"></div>
                                        <span>FEMENINO</span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <!-- Nacimiento -->
                    <div class="nacimiento">
                        <label for="nacimiento-competidor" style="color:black; font-size:1.6rem">Fecha de nacimiento del competidor</label>
                        <input id="nacimiento-competidor" class="text-white text-center with-error" type="text" placeholder="FECHA DE NACIMIENTO">
                        <small>
                            Debe cumplirse el siguiente formato: "DIA/MES/AÑO" <br>
                            * Si desea resetear el campo porque se equivocó en algún valor presione la tecla "Z"
                        </small>
                    </div>
                    <!-- Foto -->
                    <div class="foto">
                        <div class="foto-competidor" style="color:black; font-size:1.6rem"><input id="foto-competidor" class="text text-center" type="file" placeholder="FOTO"></div>
                        <label for="foto-competidor" class="file text-center col-md-12">
                            <div>SUBIR FOTO</div>
                        </label>
                    </div>

                    <h3 class="text-left">INFORMACIÓN DEPORTIVA</h3>
                    <!-- Federación -->
                    <div class="federacion">
                        <label for="federacion-competidor" style="color:black; font-size:1.6rem">Federacion del competidor</label>
                        <input id="federacion-competidor" class="text-white text-center with-error" type="text" placeholder="FEDERACIÓN">
                        <small>
                            El campo debe contener entre 3 y 30 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Club -->
                    <div class="club">
                        <label for="club-competidor" style="color:black; font-size:1.6rem">Club del competidor</label>
                        <?php if ($_SESSION['admin_level'] > 1) : ?>
                            <input id="club-competidor" class="text-white text-center with-error" type="text" value="<?php echo $_SESSION['club'] ?>" readonly>
                        <?php else : ?>
                            <select id="club-competidor" class="text-white text-center" name="club">
                                <option value="DoblasJudo">Doblas Judo</option>
                                <option value="AsocJaponesa">Asociacion Japonesa</option>
                                <option value="AsocJorgePortelli">Asociación Jorge Portelli</option>
                                <option value="AsocKarateQuilmes">Asociacion Karate Quilmes</option>
                                <option value="AsocMisionera">Asociacion Misionera de Judo</option>
                                <option value="Athenas">Athenas Judo Team</option>
                                <option value="Betsubara">Betsubara Dojo</option>
                                <option value="CentroSyuen">Centro de Educacion Fisica Syuen</option>
                                <option value="CentroMalvinasMarDelPlata">Centro de Ex Soldados Combatientes en Malvinas - Mar del plata</option>
                                <option value="Okinawense">Centro Okinawense</option>
                                <option value="JudoChascomus">Judo Chascomus</option>
                                <option value="CirculoRayoRojo">Circulo del Yudo del Rayo rojo</option>
                                <option value="DojoGoaLiniers">Dojo GOA Liniers - CABA</option>
                                <option value="DojoGoaFlorida">Dojo GOA Florida - Viciente López</option>
                                <option value="DojoGoaBecar">Dojo GOA Becar - Provincia de BS AS</option>
                                <option value="DojoGoaSerrano">Dojo GOA Serrano - CABA</option>
                                <option value="DojoGoaPasoDelRey">Dojo GOA Paso del Rey - Provincia de Bs As</option>
                                <option value="DojoGoaSanMiguel">Dojo GOA San Miguel - Provincia de Bs As</option>
                                <option value="CirculoPoliciaFederal">Circulo de Suboficiales de la Policia Federal</option>
                                <option value="ClubBancoNacion">Club Atletico Banco Nacion Argentina</option>
                                <option value="ClubElPorvenir">Club Atlético el Porvenir</option>
                                <option value="Huracan">Club Atlético Huracán</option>
                                <option value="Independiente">Club Atlético Independiente</option>
                                <option value="Ituzaingo">Club Atlético Ituzaingo</option>
                                <option value="QuilmesMarDelPlata">Club Atlético Quilmes de Mar del plata</option>
                                <option value="Velez">Club Atlético Velez Sarsfield</option>
                                <option value="ClubCiudad">Club Ciudad De Buenos Aires</option>
                                <option value="EstudiantesBahiaBlanca">Club Estudiantes De Bahia Blanca</option>
                                <option value="FerrocarrilOeste">Club Ferrocarril Oeste</option>
                                <option value="ClubItaliano">Club Italiano</option>
                                <option value="ClubLujan">Club Lujan</option>
                                <option value="LosIndios">Club Recreativo Los Indios - Moreno</option>
                                <option value="ClubSanFernando">Club San Fernando</option>
                                <option value="ClubUniversitario">Club Universitario Buenos Aires</option>
                                <option value="ColegioCrisoforoColombo">Colegio Crisóforo Colombo</option>
                                <option value="ColegioManuelBelgrano">Colegio Manuel Belgrano</option>
                                <option value="CulturalWilcoop">Cultural Wilcoop Deportivo</option>
                                <option value="DoblasJudo">Doblas Judo</option>
                                <option value="DojoArashi">Dojo Arashi Judo Tandil</option>
                                <option value="DojoBushidoKan">Dojo Bushido Kan - Mar del Plata</option>
                                <option value="DojoHimeji">Dojo Himeji - Lujan</option>
                                <option value="DojoIndia">Dojo India - Club Atletico Francisco Alvarez</option>
                                <option value="DojoJudoZambon">Dojo Judo Zambón</option>
                                <option value="DojoKentoshi">Dojo Kentoshi</option>
                                <option value="DojoNakadakari">Dojo Nakadakari</option>
                                <option value="DojoSakura">Dojo Sakura</option>
                                <option value="DojoSamuray">Dojo Samuray</option>
                                <option value="DojoSenshi">Dojo Senshi</option>
                                <option value="DojoShinnosuke">Dojo Shinnosukke</option>
                                <option value="DojoShukaku">Dojo Shukaku</option>
                                <option value="DojoTakeshi">Dojo Takeshi - Mar del Plata</option>
                                <option value="DojoVerebClaudio">Dojo Vereb Claudio</option>
                                <option value="DojoWizard">Dojo Wizard - Mar del Plata</option>
                                <option value="DojoZurita">Dojo Zurita</option>
                                <option value="EscuelaNamBuKan">Escuela de Judo y Aikido Nam Bu Kan</option>
                                <option value="EscuelaJigoroKano">Escuela de Judo Municipal Chacabuco - Jigoro Kano</option>
                                <option value="InstitutoAPAND">Instituto APAND</option>
                                <option value="InstitutoGaleano">Instituto Galeano</option>
                                <option value="InstitutoBudokan">Instituto Budokan</option>
                                <option value="InstitutoMoruli">Instituto Educativo Moruli</option>
                                <option value="InstitutoKumazawa">Instituto Kumazawa</option>
                                <option value="InstitutoNichiaGaukin">Instituto Privado Argentino Japones Nichia Gaukin</option>
                                <option value="InstitutoRenacimiento">Instituto Renacimiento</option>
                                <!-- <option value="InstitutoStratico">Instituto Stratico</option> -->
                                <option value="InstitutoUlises">Instituto Ulises</option>
                                <option value="JudoBallester">Judo Ballester</option>
                                <option value="JudoFansMadryn">Judo Fans Madryn</option>
                                <option value="JudoJuncosSanMiguel">Judo Juncos San Miguel</option>
                                <option value="JudoSanFcoJavien">Judo San Francisco Javier</option>
                                <option value="UnionTigrense">Club Atlético Union Tigrense</option>
                                <option value="ColegioGodspell">Colegio Godspell Pilar</option>
                                <option value="ColegioMarin">Colegio Marin San Isidro</option>
                                <option value="ColegioOakhillCaba">Colegio Oakhill CABA</option>
                                <option value="ColegioOakhillPilar">Colegio Oakhill Pilar</option>
                                <option value="ColegioMoorlandsCaba">Colegio St. Catherine's Moorlands CABA</option>
                                <option value="ColegioMoorlandsTortuguitas">Colegio St. Catherine's Moorlands Tortuguitas</option>
                                <option value="ColegioSanGabriel">Colegio San Gabriel</option>
                                <option value="DojoBelgrano">El Dojo Belgrano</option>
                                <option value="FundacionArgJaponesa">Fundacion Cultural Argentino Japonesa</option>
                                <option value="DojoLaOla">La Ola Dojo San Fernando</option>
                                <option value="DojoMiras">Dojo Miras</option>
                                <option value="MunicipalidadBerazategui">Municipalidad de Berazategui</option>
                                <option value="OctogonoFightClub">Octogono Fight Club</option>
                                <option value="OlympicClub">Olympic Club</option>
                                <option value="PolideportivoChacabuco">Polideportivo Chacabuco</option>
                                <option value="ResilienciaJudo">Resiliencia Judo</option>
                                <option value="Shidokan">Shidokan Judo</option>
                                <option value="DojoTakeshi">Dojo Takeshi</option>
                                <option value="UnivTecnologicaMarDelPlata">Universidad Tecnologica de Mar del Plata</option>
                                <option value="YasudaDojo">Yasuda Dojo - Club Victoria </option>
                            </select>
                            <!-- <input id="club-competidor" class="text-white text-center with-error" type="text" placeholder="CLUB"> -->
                        <?php endif; ?>
                        <small>
                            El campo debe contener entre 3 y 30 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Peso Actual -->
                    <div class="peso">
                        <label for="peso-competidor" style="color:black; font-size:1.6rem">Peso del competidor</label>
                        <input id="peso-competidor" class="text-white text-center with-error" type="number" placeholder="PESO (KG)">
                        <small>
                            No deben incluirse puntos ni caracteres especiales, solo números <br>
                        </small>
                    </div>


                    <hr>
                    <!-- Enviar formulario -->
                    <input class="text text-center" type="submit" value="CREAR">
                </form>
            </section>
        </main>
    </div>
    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>
</body>

<?php include 'templates/scripts.php'; ?>

</html>