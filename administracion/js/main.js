/************* Expresiones Regulares **************/
const formulario_cNombre =
  /^([A-Za-z]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+( ([A-Za-z]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+)*$/;
const formulario_cNombreTorneo =
  /^([A-Za-z0-9]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+( ([A-Za-z0-9]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+)*$/;
const formulario_cNumero = /^([0-9])+$/;
const formulario_cEmail =
  /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/;
const formulario_cTelefono = /^(\(([0-9])+\) )([0-9])+$/;
const formulario_cReglasTorneo =
  /^(\*( ([A-Za-z0-9]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+)+)(\n\*( ([A-Za-z0-9]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+)+)*$/;
const formulario_cHora = /^[0-9][0-9]:[0-9][0-9]$/;
const formulario_cNacimiento =
  /^([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9][0-9][0-9])$/;
/************* Expresiones Regulares **************/

/************* Funciones **************/
//Realizar operaciones sobre la base de datos
function actualizarBD(tabla, datos) {
  //Obtengo los datos necesarios para enviar el AJAX
  const $archivo = "db/operaciones/" + tabla + ".php";
  $.ajax({
    url: $archivo,
    type: "POST",
    data: datos,
    dataType: "json",
    processData: false,
    contentType: false,
    async: true,
    cache: false,
    success: function (respuesta) {
      const tipoOperacion = respuesta;
      //Operaciones exitosas
      if (tipoOperacion.respuesta == "sesion_iniciada") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡Has iniciado sesión correctamente, ${tipoOperacion.usuario}! Aguarda unos segundos y serás redirigido.`
        );
        setTimeout(() => {
          location.href = "index.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "competidor_creado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El competidor ${tipoOperacion.nombre} ${tipoOperacion.apellido} fue añadido al sistema con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-competidores.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "torneo_creado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El torneo ${tipoOperacion.nombre} fue añadido al sistema con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-torneos.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "torneo_actualizado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El torneo ${tipoOperacion.nombre} fue actualizado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-torneos.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "torneo_eliminado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El torneo fue eliminado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-torneos.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "fecha_añadida") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡La fecha del torneo fue añadida con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-torneos.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "puntos_actualizados") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡Los puntos del competidor se actualizaron con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-competidores.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "competidor_eliminado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El competidor fue eliminado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-competidores.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "competidor_actualizado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El competidor ${tipoOperacion.nombre} fue actualizado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-competidores.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "profesor_creado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El profesor ${tipoOperacion.nombre} fue actualizado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-profesores.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "profesor_eliminado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El profesor fue eliminado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-profesores.php";
        }, 5000);
      } else if (tipoOperacion.respuesta == "profesor_actualizado") {
        notificacionExito(
          "OPERACIÓN EXITOSA",
          `¡El profesor fue actualizado con éxito!`
        );
        setTimeout(() => {
          location.href = "administrar-profesores.php";
        }, 5000);
      }
      //Operaciones erroneas
      else if (tipoOperacion.respuesta == "sesion_fallida") {
        notificacionError(
          "HA OCURRIDO UN ERROR",
          `El nombre de usuario o la contraseña son incorrectos.`
        );
        setTimeout(() => {
          // location.reload();
        }, 5000);
      } else if (tipoOperacion.respuesta == "competidor_fallido") {
        notificacionError(
          "HA OCURRIDO UN ERROR",
          `La operación ha fracasado, esto puede ocurrir en caso de que el DNI o la DIRECCIÓN DE CORREO ya se encuentren asociados a otro competidor.`
        );
      } else if (tipoOperacion.respuesta == "torneo_fallido") {
        notificacionError(
          "HA OCURRIDO UN ERROR",
          `La operación ha fracasado, esto puede deberse a que ya existe otro torneo con el mismo NOMBRE`
        );
      } else if (tipoOperacion.respuesta == "fecha_fallida") {
        notificacionError(
          "HA OCURRIDO UN ERROR",
          `La fecha no pudo ser añadida al sistema`
        );
      } else if (tipoOperacion.respuesta == "puntos_fallidos") {
        notificacionError(
          "HA OCURRIDO UN ERROR",
          `Los puntos del torneo seleccionado ya se le han asignado a este usuario; si cometió un error... por favor comuníquese con un administrador`
        );
      } else if (tipoOperacion.respuesta == "profesor_fallido") {
        notificacionError("HA OCURRIDO UN ERROR", ``);
      }
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      mostrarFallaTecnica();
      console.log(textStatus + ": " + errorThrown);
    },
  });
}
//Leer los formularios y enviarlos a la base de datos
function leerFormulario(formulario, accion) {
  if (formulario == "administrador") {
    //Obtengo los campos
    const nombreUsuario = $("#username").val();
    const password = $("#password").val();
    //Realizo las validaciones correspondientes
    //Envio los datos hacia la base de datos
    const datos = new FormData();
    datos.append("usuario", nombreUsuario);
    datos.append("password", password);
    datos.append("accion", "loguear");
    actualizarBD("administrador", datos);
  } else if (formulario === "competidor") {
    if (accion === "crear" || accion === "editar") {
      //Obtengo los valores
      /* Input Text */
      const nombreCompetidor = $("#nombre-competidor");
      const apellidoCompetidor = $("#apellido-competidor");
      const dniCompetidor = $("#dni-competidor");
      const emailCompetidor = $("#email-competidor");
      const telefonoCompetidor = $("#telefono-competidor");
      const nacimientoCompetidor = $("#nacimiento-competidor");
      const federacionCompetidor = $("#federacion-competidor");
      const clubCompetidor = $("#club-competidor");
      const pesoCompetidor = $("#peso-competidor");
      /* Radio Buttons */
      const generoCompetidor = $("#genero-competidor input");
      const categoriaCompetidor = $("#categoria-competidor input");
      /* Image Files */
      const fotoCompetidor = $("#foto-competidor");
      //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
      /* Nombre */
      if (!validarCampo(nombreCompetidor, 3, 60, formulario_cNombre))
        return false;
      /* Apellido */
      if (!validarCampo(apellidoCompetidor, 3, 60, formulario_cNombre))
        return false;
      /* DNI */
      if (!validarCampo(dniCompetidor, 0, 9999, formulario_cNumero))
        return false;
      /* Email */
      if (!validarCampo(emailCompetidor, 0, 9999, formulario_cEmail))
        return false;
      /* Telefono */
      if (!validarCampo(telefonoCompetidor, 0, 9999, formulario_cTelefono))
        return false;
      /* Género */
      if (!validarRadioButton(generoCompetidor)) return false;
      /* Nacimiento */
      if (!validarCampo(nacimientoCompetidor, 0, 9999, formulario_cNacimiento))
        return false;
      /* Foto */
      if (accion == "crear") {
        if (!validarFoto(fotoCompetidor)) return false;
      }
      /* Federación */
      if (!validarCampo(federacionCompetidor, 3, 30, formulario_cNombre))
        return false;
      /* Club */
      if (!validarCampoObligadorio(clubCompetidor)) return false;
      /* Peso */
      if (!validarCampo(pesoCompetidor, 0, 9999, formulario_cNumero))
        return false;
      /* Categoría */
      if (!validarRadioButton(categoriaCompetidor)) return false;

      //Envio los datos hacia la base de datos
      const datos = new FormData();
      if (accion == "editar") {
        const id = $("#id-competidor").val();
        datos.append("id", id);
      }
      datos.append("nombre", nombreCompetidor.val().toUpperCase());
      datos.append("apellido", apellidoCompetidor.val().toUpperCase());
      datos.append("dni", dniCompetidor.val());
      datos.append("email", emailCompetidor.val().toUpperCase());
      datos.append("telefono", telefonoCompetidor.val());
      datos.append(
        "genero",
        $("#genero-competidor input:checked").val().toUpperCase()
      );
      datos.append("nacimiento", nacimientoCompetidor.val());
      datos.append("foto", fotoCompetidor.prop("files")[0]);
      datos.append("federacion", federacionCompetidor.val().toUpperCase());
      datos.append("club", clubCompetidor.val());
      datos.append("peso", pesoCompetidor.val().toUpperCase());
      datos.append(
        "categoria",
        $("#categoria-competidor input:checked").val().toUpperCase()
      );
      datos.append("accion", accion);
      actualizarBD("competidor", datos);
    }
  } else if (formulario === "torneo") {
    if (accion === "crear" || accion === "editar") {
      //Obtengo los valores
      /* Input Text */
      const nombreTorneo = $("#nombre-torneo");
      /* Checkbox Buttons */
      const categoriasTorneo = $("#categorias-torneo input");
      const inscripcionHabilitada = $('#inscripcion-habilitada').is(':checked');
      /* Archivo */
      const reglasTorneo = $("#reglas-torneo");
      const resultadosTorneo = $("#resultados-torneo");
      // Arhivo imagen
      const imagenTorneo = $(".fotarda");
      //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
      /* Nombre */
      if (!validarCampo(nombreTorneo, 5, 30, formulario_cNombreTorneo))
        return false;
      /* Categorias */
      if (!validarCheckboxButton(categoriasTorneo)) return false;
      /* Reglas */
      if (accion === "crear") {
        // if (!validarArchivo(reglasTorneo)) return false;
      }
      /* Resultados */
      if (accion === "crear") {
        // if (!validarArchivo(resultadosTorneo)) return false;
      }
      /* Foto */
      if (accion === "crear") {
        // if (!validarFoto(imagenTorneo)) return false;
      }
      //Envio los datos hacia la base de datos
      const datos = new FormData();
      if (accion === "editar") {
        const id = $("#id-torneo").val();
        datos.append("id", id);
      }
      datos.append("nombre", nombreTorneo.val().toUpperCase());
      datos.append("categorias", obtenerValorCheckBox(categoriasTorneo));
      datos.append("reglas", reglasTorneo.prop("files")[0]);
      datos.append("resultados", resultadosTorneo.prop("files")[0]);
      datos.append("imagen", imagenTorneo.prop("files")[0]);
      datos.append("accion", accion);
      datos.append("inscripcion", inscripcionHabilitada ? '1' : '0');
      actualizarBD("torneo", datos);
    }
  } else if (formulario == "profesor") {
    if (accion == "crear" || accion == "editar") {
      //Obtengo los valores
      /* Input Text */
      const club = $("#club");
      const nombreProfesor = $("#nombre-profesor");
      const emailProfesor = $("#email-profesor");
      const usuario = $("#usuario-profesor");
      const pass = $("#password-profesor");
      //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
      /* Nombre */
      if (!validarCampoObligadorio(nombreProfesor)) return false;
      /* Apellido */

      /* Email */
      if (!validarCampo(emailProfesor, 0, 9999, formulario_cEmail))
        return false;
      if (!validarCampoObligadorio(usuario)) return false;
      if (!validarCampoObligadorio(pass) && accion != "editar") return false;

      //Envio los datos hacia la base de datos
      const datos = new FormData();
      if (accion == "editar") {
        const id = $("#id-profesor").val();
        datos.append("id", id);
      }
      datos.append("nombre", nombreProfesor.val().toUpperCase());
      datos.append("email", emailProfesor.val().toUpperCase());
      datos.append("club", club.val());
      datos.append("usuario", usuario.val().toUpperCase());
      datos.append("pass", pass.val());
      datos.append("accion", accion);
      actualizarBD("profesor", datos);
    }
  }
}
//Validación de formularios
function validarCampo(campo, lMinima, lMaxima, formato) {
  if (
    validarCampoObligadorio(campo) &&
    validarLongitudCampo(campo, lMinima, lMaxima) &&
    validarFormatoCampo(campo, formato)
  ) {
    return true;
  }
  notificacionError(
    "¡ERROR!",
    "El último campo de texto que se ha puesto en rojo no cumple con los requisitos especificados, por favor, corríjalo"
  );
  return false;
}
function validarCampoObligadorio(campo) {
  if (campo.val().length > 0 || camposNoObligatorios(campo)) {
    $(campo).css("border", "solid .2rem #009975");
    return true;
  }
  $(campo).css("border", "solid .5rem var(--colorRojo)");
  return false;
}
function camposNoObligatorios(campo) {
  // Lista predefinida de IDs de clubes permitidos
  var camposNoObligatorios = ["telefono-competidor", "club2", "club3"];

  // Verificar si el valor seleccionado está incluido en la lista de clubes permitidos
  return camposNoObligatorios.includes(campo[0].id);
}
function validarLongitudCampo(campo, lMinima, lMaxima) {
  if (
    (campo.val().length >= lMinima && campo.val().length <= lMaxima) ||
    camposNoObligatorios(campo)
  ) {
    $(campo).css("border", "solid .2rem #009975");
    return true;
  }
  $(campo).css("border", "solid .5rem var(--colorRojo)");
  return false;
}
function validarFormatoCampo(campo, formato) {
  if (
    formato == "libre" ||
    formato.test(campo.val()) ||
    camposNoObligatorios(campo)
  ) {
    $(campo).css("border", "solid .2rem #009975");
    return true;
  }
  $(campo).css("border", "solid .5rem var(--colorRojo)");
  return false;
}
function validarRadioButton(radioButton) {
  if (!radioButton.is(":checked")) {
    let campoError = radioButton.parent().parent().parent()[0];
    campoError = $(campoError).attr("value");
    notificacionError(
      "¡ERROR!",
      "Debes seleccionar una opción en el campo " + campoError
    );
    return false;
  }
  return true;
}
function validarCheckboxButton(checkboxButton) {
  let contador = 0;
  let campoError = checkboxButton.parent().parent().parent()[0];
  campoError = $(campoError).attr("value");
  $(checkboxButton).each(function (index, element) {
    if ($(this).is(":checked")) {
      contador++;
    }
  });
  if (contador > 0) return true;
  notificacionError(
    "¡ERROR!",
    "Debes seleccionar una opción en el campo " + campoError
  );
  return false;
}
function validarFoto(archivo) {
  if (!archivo[0].files.length) {
    notificacionError(
      "¡ERROR!",
      "No has subido una foto de forma correcta, verifica que el nombre del archivo figure en el campo foto para asegurarte de que se subió correctamente"
    );
    return false;
  }
  return true;
}
function validarArchivo(archivo) {
  if (!archivo[0].files.length) {
    notificacionError(
      "¡ERROR!",
      "No has subido un archivo de forma correcta, verifica que el nombre del archivo figure en el campo foto para asegurarte de que se subió correctamente"
    );
    return false;
  }
  return true;
}
//Obtener valores de formularios
function obtenerValorCheckBox(checkboxButton) {
  let valor = "{";
  $(checkboxButton).each(function (index, element) {
    if ($(this).is(":checked")) {
      if (valor.length == 1) valor = valor + $(this).val();
      else valor = valor + ", " + $(this).val();
    }
  });
  valor = valor + "}";
  return valor;
}
//Envíos de mensajes
function mostrarFallaTecnica() {
  Swal.fire({
    type: "error",
    title: `<p style="font-size: 30px;">¡Error!</p>`,
    html: `<p style="font-size: 15px;">Ha ocurrido una falla técnica. Solicite a un administrador que revise el asunto.</p>`,
    showConfirmButton: false,
    timer: 4500,
  });
}
function notificacionExito(titulo, mensaje) {
  Swal.fire({
    type: "success",
    title: `<p style="font-size: 30px;">${titulo}</p>`,
    html: `<p style="font-size: 15px;">${mensaje}</p>`,
    showConfirmButton: false,
    timer: 4500,
  });
}
function notificacionError(titulo, mensaje) {
  Swal.fire({
    type: "error",
    title: `<p style="font-size: 30px;">${titulo}</p>`,
    html: `<p style="font-size: 15px;">${mensaje}</p>`,
    showConfirmButton: false,
    timer: 4500,
  });
}
//Adicionales
function calcularWidthPorcentual(width, widthMaximo) {
  return Math.round((100 * width) / widthMaximo);
}
/************* Funciones **************/

/************* Códigos Adicionales/Plugins **************/
//Configuración para los inputs file
jQuery("#foto-competidor").change(function () {
  let archivoSubido = this["files"][0];
  if (archivoSubido["size"] > 10000000) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html("ARCHIVO PESADO. MAX: 10MB");
    this.value = "";
  } else if (
    archivoSubido["type"] != "image/png" &&
    archivoSubido["type"] != "image/jpg" &&
    archivoSubido["type"] != "image/jpeg"
  ) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html("TIPO DE ARCHIVO NO SOPORTADO");
    this.value = "";
  } else {
    var filename = jQuery(this).val().split("\\").pop();
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html(filename);
  }
});
jQuery("#reglas-torneo").change(function () {
  let archivoSubido = this["files"][0];
  if (archivoSubido["size"] > 10000000) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html("ARCHIVO PESADO. MAX: 10MB");
    this.value = "";
  } else if (
    archivoSubido["type"] != "application/pdf" &&
    archivoSubido["type"] !=
      "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
    archivoSubido["type"] !=
      "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
  ) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html("TIPO DE ARCHIVO NO SOPORTADO");
    this.value = "";
  } else {
    var filename = jQuery(this).val().split("\\").pop();
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html(filename);
  }
});

jQuery("#resultados-torneo").change(function () {
  let archivoSubido = this["files"][0];
  if (archivoSubido["size"] > 10000000) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
        .next()
        .find("div")
        .html("ARCHIVO PESADO. MAX: 10MB");
    this.value = "";
  } else if (
      archivoSubido["type"] != "application/pdf" &&
      archivoSubido["type"] !=
      "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
      archivoSubido["type"] !=
      "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
  ) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
        .next()
        .find("div")
        .html("TIPO DE ARCHIVO NO SOPORTADO");
    this.value = "";
  } else {
    var filename = jQuery(this).val().split("\\").pop();
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
        .next()
        .find("div")
        .html(filename);
  }
});
jQuery(".fotarda").change(function () {
  let archivoSubido = this["files"][0];
  if (archivoSubido["size"] > 10000000) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html("ARCHIVO PESADO. MAX: 10MB");
    this.value = "";
  } else if (
    archivoSubido["type"] != "image/png" &&
    archivoSubido["type"] != "image/jpg" &&
    archivoSubido["type"] != "image/jpeg"
  ) {
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html("TIPO DE ARCHIVO NO SOPORTADO");
    this.value = "";
  } else {
    var filename = jQuery(this).val().split("\\").pop();
    var idname = jQuery(this).attr("id");
    jQuery("div." + idname)
      .next()
      .find("div")
      .html(filename);
  }
});
//Configuración para campos que contengan fechas
$("#nacimiento-competidor").on("input", function () {
  let valorActual = $(this).val();
  let longitud = valorActual.length;
  //Ingreso los elementos y evito que se ingresen mas caracteres de lo deseado
  if (valorActual.includes("Z") || valorActual.includes("z")) $(this).val("");
  else if (longitud == 2 || longitud == 5) $(this).val(valorActual + "/");
  else if (longitud == 11) $(this).val(valorActual.slice(0, -1));
});
$(".datepicker-fechas").datepicker({
  title: "Fecha de Concurrencia",
  format: "yyyy-mm-dd",
  startDate: "d",
});
//Configuración para las tablas de administracion
// $("#tabla-administrar").paginate({
//   elemsPerPage: 5,
//   maxButtons: 5,
// });
if ($("#admin_level").val() == 2) {
  $(".tabla-index-1 table").paginate({
    elemsPerPage: 15,
    maxButtons: 5,
  });
} else {
  $(".tabla-index-1 table").paginate({
    elemsPerPage: 5,
    maxButtons: 5,
  });
}
$(".tabla-index-2 table").paginate({
  elemsPerPage: 5,
  maxButtons: 5,
});
/************* Códigos Adicionales/Plugins **************/

$(document).ready(function () {
  /************* Login **************/
  //Formulario
  let formularioLogin = $("#formulario-login");
  if (formularioLogin.length) {
    $("#username").val("");
    $("#password").val("");

    $(formularioLogin).on("submit", function () {
      leerFormulario("administrador", "");
      return false;
    });
  }
  /************* Login **************/

  /************* Panel de Administración - Sidebar **************/
  const sidebar = $("#sidebar");
  if (sidebar.length) {
    const botonSidebar = $("#boton-sidebar");
    const categoriasSidebar = $("#sidebar .categorias");
    const contenidoPrincipal = $("#contenido-principal");
    let sidebarAbierto = false;

    let widthMaximo = $("#admin-index").css("width");
    widthMaximo = parseInt(widthMaximo);
    let sidebarInicial = $(sidebar).css("width");
    sidebarInicial = parseInt(sidebarInicial);
    sidebarInicial = calcularWidthPorcentual(sidebarInicial, widthMaximo);
    let cpInicial = $(contenidoPrincipal).css("width");
    cpInicial = parseInt(cpInicial);
    cpInicial = calcularWidthPorcentual(cpInicial, widthMaximo);
    $(botonSidebar).on("click", function () {
      if (sidebarAbierto) {
        //Desaparezco el contenido del navbar
        $(categoriasSidebar).hide(500);
        //Cierro el navbar
        $(sidebar).css("width", `${parseInt(sidebarInicial)}%`);
        $(contenidoPrincipal).css("width", `${parseInt(cpInicial)}%`);
        //Seteo la variable a cerrado
        sidebarAbierto = false;
      } else {
        let widthSidebar = 0;
        let widthCP = 0;
        if (sidebarInicial == 15) {
          widthSidebar = sidebarInicial + 85;
          widthCP = cpInicial - 85;
        } else {
          widthSidebar = sidebarInicial + 30;
          widthCP = cpInicial - 30;
        }
        //Abro el navbar
        $(sidebar).css("width", `${widthSidebar}%`);
        $(contenidoPrincipal).css("width", `${widthCP}%`);
        //Aparezco el contenido del navbar
        $(categoriasSidebar).show(100);
        //Seteo la variable a abierto
        sidebarAbierto = true;
      }
    });
  }
  /************* Panel de Administración - Sidebar **************/

  /************* Panel de Administración - Nuevo Competidor **************/
  //Formulario
  let formularioCrearCompetidor = $("#crear-competidor");
  if (formularioCrearCompetidor.length) {
    // $("#nombre-competidor").val("");
    // $("#apellido-competidor").val("");
    // $("#dni-competidor").val("");
    // $("#email-competidor").val("");
    // $("#telefono-competidor").val("");
    // $("#nacimiento-competidor").val("");
    // $("#federacion-competidor").val("");
    // $("#club-competidor").val("");
    // $("#peso-competidor").val("");

    $(formularioCrearCompetidor).on("submit", function () {
      leerFormulario("competidor", "crear");
      return false;
    });
  }
  /************* Panel de Administración - Nuevo Competidor **************/

  /************* Panel de Administración - Editar Competidor **************/
  //Formulario
  let formularioEditarCompetidor = $("#editar-competidor");
  if (formularioEditarCompetidor.length) {
    $(formularioEditarCompetidor).on("submit", function () {
      leerFormulario("competidor", "editar");
      return false;
    });
  }
  /************* Panel de Administración - Editar Competidor **************/

  /************* Panel de Administración - Eliminar Competidor **************/
  //Formulario
  let botonEliminarCompetidor = $("table #eliminar-competidor");
  if (botonEliminarCompetidor.length) {
    $(botonEliminarCompetidor).on("click", function () {
      //Obtengo el ID a eliminar
      const idCompetidor = $(this).attr("data-competidor");
      //Envío la operación a la base de datos
      const datos = new FormData();
      datos.append("id", idCompetidor);
      datos.append("accion", "eliminar");

      actualizarBD("competidor", datos);
      return false;
    });
  }
  /************* Panel de Administración - Eliminar Competidor **************/

  /************* Panel de Administración - Sumar Puntos **************/
  //Formulario
  let formularioSumarPuntos = $("#modal-puntos #actualizar-puntos-competidor");
  if (formularioSumarPuntos.length) {
    $(formularioSumarPuntos).on("submit", function () {
      //Obtengo los campos
      const idCompetidor = $(this).attr("data-usuario");
      const torneo_seleccionado = $(this[0]);
      const puntos_senior = $(this[1]);
      const puntos_cadete = $(this[2]);
      const puntos_kyu_graduado = $(this[3]);
      const puntos_kyu_novicio = $(this[4]);
      const puntos_infantil_b = $(this[5]);
      const puntos_junior = $(this[6]);
      //Realizo la operación en la base de datos
      const datos = new FormData();
      datos.append("id", idCompetidor);
      datos.append("torneo", torneo_seleccionado.val());
      datos.append("puntos-senior", parseInt(puntos_senior.val()));
      datos.append("puntos-cadete", parseInt(puntos_cadete.val()));
      datos.append("puntos-kyu-graduado", parseInt(puntos_kyu_graduado.val()));
      datos.append("puntos-kyu-novicio", parseInt(puntos_kyu_novicio.val()));
      datos.append("puntos-infantil-b", parseInt(puntos_infantil_b.val()));
      datos.append("puntos-junior", parseInt(puntos_junior.val()));
      datos.append("accion", "sumar-puntos");

      actualizarBD("competidor", datos);
    });
  }
  /************* Panel de Administración - Sumar Puntos **************/

  /************* Panel de Administración - Nuevo Torneo **************/
  //Formulario
  let formularioCrearTorneo = $("#crear-torneo");
  if (formularioCrearTorneo.length) {
    $("#nombre-torneo").val("");
    $("#reglas-torneo").val("");

    $(formularioCrearTorneo).on("submit", function () {
      leerFormulario("torneo", "crear");
      return false;
    });
  }
  /************* Panel de Administración - Nuevo Torneo **************/

  /************* Panel de Administración - Editar Torneo **************/
  //Formulario
  let formularioEditarTorneo = $("#editar-torneo");
  if (formularioEditarTorneo.length) {
    $(formularioEditarTorneo).on("submit", function () {
      leerFormulario("torneo", "editar");
      return false;
    });
  }
  /************* Panel de Administración - Editar Torneo **************/

  /************* Panel de Administración - Eliminar Torneo **************/
  //Formulario
  let botonEliminarTorneo = $("table #eliminar-torneo");
  if (botonEliminarTorneo.length) {
    $(botonEliminarTorneo).on("click", function () {
      //Obtengo el ID a eliminar
      const idTorneo = $(this).attr("data-torneo");
      //Envío la operación a la base de datos
      const datos = new FormData();
      datos.append("id", idTorneo);
      datos.append("accion", "eliminar");

      actualizarBD("torneo", datos);
      return false;
    });
  }
  /************* Panel de Administración - Eliminar Torneo **************/

  /************* Panel de Administración - Agregar Fechas **************/
  //Formulario
  let formularioNuevaFecha = $("#modal-fecha #añadir-fecha");
  if (formularioNuevaFecha.length) {
    $(formularioNuevaFecha).on("submit", function () {
      //Obtengo los campos
      const idTorneo = $(this).attr("data-torneo");
      const fecha = $(this[0]);
      const hora = $(this[1]);
      const direccion = $(this[2]);

      //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
      /* Fecha */
      if (!validarCampo(fecha, 0, 9999, "libre")) return false;
      /* Hora */
      if (!validarCampo(hora, 0, 9999, formulario_cHora)) return false;
      /* Dirección */
      if (!validarCampo(direccion, 5, 60, "libre")) return false;

      //Realizo la operación en la base de datos
      const datos = new FormData();
      datos.append("id", idTorneo);
      datos.append("fecha", fecha.val().toUpperCase());
      datos.append("hora", hora.val().toUpperCase());
      datos.append("direccion", direccion.val().toUpperCase());
      datos.append("accion", "nueva-fecha");

      actualizarBD("torneo", datos);
    });
  }
  /************* Panel de Administración - Agregar Fechas **************/

  /************* Panel de Administración - Nuevo profesor **************/
  //Formulario
  let formularioCrearProfesor = $("#crear-profesor");
  if (formularioCrearProfesor.length) {
    $(formularioCrearProfesor).on("submit", function () {
      leerFormulario("profesor", "crear");
      return false;
    });
  }
  /************* Panel de Administración - Nuevo profesor **************/
  /************* Panel de Administración - Nuevo profesor **************/
  //Formulario
  let formularioEditarProfesor = $("#editar-profesor");
  if (formularioEditarProfesor.length) {
    console.log("aaa");
    $(formularioEditarProfesor).on("submit", function () {
      leerFormulario("profesor", "editar");
      return false;
    });
  }
  /************* Panel de Administración - Nuevo profesor **************/

  /************* Panel de Administración - Eliminar profesor **************/
  //Formulario
  let botonEliminarProfesor = $("table #eliminar-profesor");
  if (botonEliminarProfesor.length) {
    $(botonEliminarProfesor).on("click", function () {
      //Obtengo el ID a eliminar
      const idProfesor = $(this).attr("data-profesor");
      //Envío la operación a la base de datos
      const datos = new FormData();
      datos.append("id", idProfesor);
      datos.append("accion", "eliminar");

      actualizarBD("profesor", datos);
      return false;
    });
  }
  /************* Panel de Administración - Eliminar profesor **************/
});
