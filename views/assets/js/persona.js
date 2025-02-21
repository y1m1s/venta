$(document).ready(function () {
    getTipoDocumento();
    getTipoDocumentoSelect();
    paginaActual = 1;
    getPersona(paginaActual);



    $("#buscarPersona").on("keyup", function () {
        getPersona(1); // Mantiene la misma página al buscar
    });
    //                             
    //                                                Mostrar cantidad de registros 
    // ============================================================================================================
    $("#mostrarPersonas").on("change", function () {
        if ($(this).val() === "") {
            alert("Por favor, selecciona una opción válida.");
        } else {
            paginaActual = 1;
            getPersona(paginaActual); // Mantiene la misma página al cambiar la cantidad
        }
    });
    /*
    ============================================================================================================
    |                                               Validaciones de campos                                                  |
    ============================================================================================================
    */
    $documento = $("#tipoDocumentoSelect");
    $errorDocumento = $("#errorDocumento");

    $documento.on("change", function () {
        if ($(this).val().trim() !== "") {

            $errorDocumento.addClass("d-none");
            $documento.focus().removeClass("error-campo-focus");

        }
    });
    $nroDocumento = $("#nroDocumento");
    $erroNroDoccumento = $("#errorNroDocumento");

    $nroDocumento.on("input", function () {
        if ($(this).val().trim() !== "") {

            $erroNroDoccumento.addClass("d-none");
            $nroDocumento.focus().removeClass("error-campo-focus");

        }
    });

    $errorNombreRazonSocial = $("#errorNombreRazonSocial");
    $nombreRazonSocial = $("#nombreRazonSocial");
    $nombreRazonSocial.on("input", function () {
        if ($(this).val().trim() !== "") {

            $errorNombreRazonSocial.addClass("d-none");
            $nombreRazonSocial.focus().removeClass("error-campo-focus");

        }
    });

    $errorDireccion = $("#errorDireccion");
    $direccion = $("#direccion");
    $direccion.on("input", function () {
        if ($(this).val().trim() !== "") {

            $errorDireccion.addClass("d-none");
            $direccion.focus().removeClass("error-campo-focus");



        }
    });








});
//                             
//                                                Modales
// ============================================================================================================
function configurarModal(abrirId, modalId, cerrarClase) {
    const abrirModal = document.getElementById(abrirId);
    const modal = document.getElementById(modalId);
    const cerrar = modal.querySelector(`.${cerrarClase}`); // Asegura que se cierre el modal correcto

    abrirModal.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    cerrar.onclick = () => modal.style.display = 'none';

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Configurar múltiples modales
configurarModal('modalTipoDocumento', 'miModalTipoDocumento', 'cerrar');
//                             
//                                                Tipo Documento
// ============================================================================================================
$("#btnSetTipoDocumento").click(function (e) {
    e.preventDefault();
    setTipoDocumento(); // Llamar a la función
});
$(document).on('click', '.btnEliminarTipoDocumento', deleteTipoDocumento);
$(document).on('click', '.btnEditarTipoDocumento', updateTipoDocumento);

function setTipoDocumento() {
    const tipoDocumento = $("#tipoDocumento").val();

    if (tipoDocumento) {
        $.post("ajax/tipoDocumentoAjax.php", {
            accion: "crearTipoDocumento",
            tipoDocumento: tipoDocumento,
        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                if (data.status === "success") {
                    alert(data.message);
                    getTipoDocumento();
                    limpiarTiposDocumentos();
                    getTipoDocumentoSelect();
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
            }
        });
    } else {
        alert("Por favor, completa todos los campos.");
    }
}

function getTipoDocumento() {

    $.post("ajax/tipoDocumentoAjax.php", {
        accion: "mostrarTipoDocumento"
    }, function (respuesta) {
        try {
            const data = JSON.parse(respuesta);
            const tipos_documentos = data.tipos_documentos;

            let html = "";
            tipos_documentos.forEach(function (tiposDocumentos) {
                html += `
                <tr class="text-center">
                    <td>${tiposDocumentos.id_tipo_documento}</td>
                    <td>${tiposDocumentos.documento}</td>
                    <td>
                        <button type="button" class="btn bg-primary btnEditarTipoDocumento" data-id_tipo_documento="${tiposDocumentos.id_tipo_documento}" data-tipo_documento="${tiposDocumentos.documento}" >Editar</button>
                        <button type="button" class="btn bg-danger btnEliminarTipoDocumento" data-id_tipo_documento="${tiposDocumentos.id_tipo_documento}">Eliminar</button>
                    </td>
                </tr>
            `;
            });
            $("#tablaTiposDocumentos tbody").html(html);
        } catch (error) {
            console.error("Error al procesar los datos:", error, respuesta);
        }
    });

}

function getTipoDocumentoSelect() {

    $.post("ajax/tipoDocumentoAjax.php", {
        accion: "mostrarTipoDocumento"
    }, function (respuesta) {
        try {
            const data = JSON.parse(respuesta);
            const tipos_documentos = data.tipos_documentos;

            let html = '<option value="">Seleccionar ...</option>'; // Opcional: con la opción por defecto

            tipos_documentos.forEach(function (tiposDocumentos) {
                html += `
            <option value="${tiposDocumentos.id_tipo_documento}">${tiposDocumentos.documento}</option>
        `;
            });

            // Actualizar el contenido del select
            $("#tipoDocumentoSelect").html(html);
        } catch (error) {
            console.error("Error al procesar los datos deñ select :", error, respuesta);
        }
    });

}

function deleteTipoDocumento() {
    const idTipoDocumento = $(this).data('id_tipo_documento');
    ModalConfirm.confirmarConCancelar("¿Seguro que deseas eliminar este tipo de docuemnto?", function () {
        $.post("ajax/tipoDocumentoAjax.php", {
            accion: "eliminarTipoDocumento",
            idTipoDocumento: idTipoDocumento
        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                ModalConfirm.confirmarSoloAceptar(data.message);
                if (data.status === "success") {
                    getTipoDocumento();
                    getTipoDocumentoSelect();
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
                alert("Error inesperado. Revisa la consola.");
            }
        });
    });

}

function updateTipoDocumento() {
    const idTipoDocumento = $(this).data('id_tipo_documento');
    const tipoDocumento = $(this).data('tipo_documento');

    $("#tipoDocumento").val(tipoDocumento);
    $("#btnSetTipoDocumento").text("Actualizar");
    $("#btnSetTipoDocumento").off("click").click(function (e) {
        e.preventDefault();
        $.post("ajax/tipoDocumentoAjax.php", {
            accion: "editarTipoDocumento",
            idTipoDocumento: idTipoDocumento,
            nombre_tipoDocumento: $("#tipoDocumento").val(),

        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                if (data.status === "success") {
                    ModalConfirm.confirmarSoloAceptar(data.message);
                    getTipoDocumento();
                    limpiarTiposDocumentos()
                    getTipoDocumentoSelect();
                    // Mantiene la misma página después de editar
                    $("#btnSetTipoDocumento").text("Aceptar");
                    $("#btnSetTipoDocumento").off("click").on("click", function (e) {
                        e.preventDefault();
                        setTipoDocumento();

                    });
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta actualizar :", error, respuesta);
            }
        });
    });
}

function limpiarTiposDocumentos() {
    $("#tipoDocumento").val("");

}
//                             
//                                                Personas
// ============================================================================================================
$("#btnIngresarPersona").click(function (e) {
    e.preventDefault();
    setPersona();
});


function setPersona() {
    let errorDocumento = $("#errorDocumento");
    let errorNroDocumento = $("#errorNroDocumento");
    let errorNombreRazonSocial = $("#errorNombreRazonSocial");
    let errorDireccion = $("#errorDireccion");
    let $direc = $("#direccion");
    let $documento = $("#tipoDocumentoSelect").trigger("change");
    let $nrDoc = $("#nroDocumento");
    let tipoDocumentoSelect = $documento.val().trim();
    let nroDocumento = $nrDoc.val();
    let $nRS = $("#nombreRazonSocial");
    let nombreRazonSocial = $nRS.val();
    let direccion = $direc.val();
    let telefono = $("#telefono").val();
    let mensajeError = ["Selecciona un tipo de documento", "Ingresa un numero de documento", "Ingresa un nombre / razon Social", "Ingresa una direccion"];
    if (tipoDocumentoSelect === "") {
        $documento.focus().addClass("error-campo-focus");
        errorDocumento.removeClass("d-none");
        errorDocumento.html(mensajeError[0]);
    } else if (nroDocumento === "") {
        $nrDoc.focus().addClass("error-campo-focus");
        errorNroDocumento.removeClass("d-none");
        errorNroDocumento.html(mensajeError[1]);
    } else if (nombreRazonSocial === "") {
        $nRS.focus().addClass("erro-campo-focus");
        errorNombreRazonSocial.removeClass("d-none");
        errorNombreRazonSocial.html(mensajeError[2]);
    } else if (direccion === "") {
        $direc.focus().addClass("erro-campo-focus");
        errorDireccion.removeClass("d-none");
        errorDireccion.html(mensajeError[3]);
    } else {
        $.post("ajax/personaAjax.php", {
            accion: "crearPersona",
            tipoDocumentoSelect: tipoDocumentoSelect,
            nroDocumento: nroDocumento,
            nombreRazonSocial: nombreRazonSocial,
            direccion: direccion,
            telefono: telefono
        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                if (data.status === "success") {
                    ModalConfirm.confirmarSoloAceptar(data.message);
                    getPersona(paginaActual);
                    limpiarPersona();
                } else {
                    ModalConfirm.confirmarSoloAceptar(data.message);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
            }
        });
    }

}


function getPersona(paginaPersonas) {
    let mostrarPersonas = $("#mostrarPersonas").val();
    let buscarPersona = $("#buscarPersona").val();

    $.post("ajax/personaAjax.php", {
        accion: "buscarPersona",
        buscarPersona: buscarPersona,
        mostrarPersonas: mostrarPersonas,
        paginaPersonas: paginaPersonas
    },
        function (respuesta) {

            try {
                const data = respuesta;
                const personas = data.personas;
                const total = data.total;
                const totalPaginas = data.totalPaginas;
                let html = "";

                personas.forEach(function (persona) {
                    html += `
                    <tr class="text-center">
                        <td>${persona.id_persona}</td>
                        <td>${persona.documento}</td>
                        <td>${persona.nro_documento}</td>
                        <td>${persona.nombre_razon_social}</td>
                        <td>${persona.direccion}</td>
                        <td>${persona.telefono}</td>
                        <td>
                            <button class="btn bg-primary btnEditarPersona" 
                                data-id_persona="${persona.id_persona}" 
                                data-documento="${persona.id_tipo_documento}" 
                                data-nro_documento="${persona.nro_documento}"
                                data-nombre_razon_social="${persona.nombre_razon_social}"
                                data-direccion="${persona.direccion}"
                                data-telefono="${persona.telefono}">
                                <img src="views/assets/img/editar.svg" alt="">
                            </button>
                            <button class="btn bg-danger btnEliminarPersona" data-id_persona="${persona.id_persona}">
                              <img src="views/assets/img/eliminar.svg" alt="">
                            </button>
                        </td>
                    </tr>`;
                });

                $("#tablaPersonas tbody").html(html);

                // Corregido el uso de `personas.length`
                $("#infoRegistros").text(`Mostrando ${personas.length} de ${total} registros`);

                let paginacionHtml = "";
                for (let i = 1; i <= totalPaginas; i++) {
                    paginacionHtml += `
                    <li class="page-item ${i === paginaPersonas ? 'active' : ''}">
                        <a href="#" class="page-link" onclick="paginaActual = ${i}; getPersona(${i}); return false;">${i}</a>
                    </li>`;
                }
                $(".pagination").html(paginacionHtml);
            } catch (error) {
                console.error("Error al procesar los datos:", error, respuesta);
            }
        });

    paginaActual = paginaPersonas;
}
$(document).off("click", ".btnEliminarPersona").on("click", ".btnEliminarPersona", deletePersona);


function deletePersona() {
    let idPersona = $(this).data("id_persona");
    ModalConfirm.confirmarConCancelar("¿Seguro que deseas eliminar a este cliente?", function () {
        $.post("ajax/personaAjax.php", {
            accion: "eliminarPersona",
            idPersona: idPersona
        }, function (respuesta) {
            try {
                let data = JSON.parse(respuesta);
                ModalConfirm.confirmarSoloAceptar(data.message);
                if (data.status === "success") {
                    getPersona(paginaActual);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
                alert("Error inesperado. Revisa la consola.");
            }
        });
    });
}

$(document).on('click', '.btnEditarPersona', updatePersona);

function updatePersona() {

    let idPersona = $(this).data("id_persona");
    let documento = $(this).data("documento");
    let nroDocumento = $(this).data("nro_documento");
    let nombreRazonSocial = $(this).data("nombre_razon_social");
    let direccion = $(this).data("direccion");
    let telefono = $(this).data("telefono");


    $("#tipoDocumentoSelect").val(documento).trigger("change");
    $("#nroDocumento").val(nroDocumento);
    $("#nombreRazonSocial").val(nombreRazonSocial);
    $("#direccion").val(direccion);
    $("#telefono").val(telefono);
    $("#btnIngresarPersona").text("Actualizar");

    $("#btnIngresarPersona").off("click").click(function (e) {
        e.preventDefault();
        $.post("ajax/personaAjax.php", {
            accion: "editarPersona",
            idPersona: idPersona,
            documento: $("#tipoDocumentoSelect").val(),
            nroDocumento: $("#nroDocumento").val(),
            nombreRazonSocial: $("#nombreRazonSocial").val(),
            direccion: $("#direccion").val(),
            telefono: $("#telefono").val()

        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                if (data.status === "success") {
                    ModalConfirm.confirmarSoloAceptar(data.message);
                    getPersona(paginaActual);
                    limpiarPersona();
                    $("#btnIngresarPersona").text("Aceptar");
                    $("#btnIngresarPersona").off("click").on("click", function (e) {
                        e.preventDefault();
                        setPersona();

                    });
                } else {
                    ModalConfirm.confirmarSoloAceptar(data.message);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta actualizar :", error, respuesta);
            }
        });
    });
}

function limpiarPersona() {


    $("#tipoDocumentoSelect").val("").trigger("change");
    $("#nroDocumento").val("");
    $("#nombreRazonSocial").val("");
    $("#direccion").val("");
    $("#telefono").val("");
}