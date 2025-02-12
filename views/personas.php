<div class="box-title">
    <h1>PERSONAS</h1>
</div>
<div class="box">
    <!--                                                                    -->
    <!--                           Ingresar Datos                           -->
    <!--  ================================================================= -->
    <div class="box ">
        <form autocomplete="off">
            <div class="d-grid">
                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/documento.svg" alt="">
                        <label for="nombre" class="form-label">Tipo Documento:</label>
                    </div>
                    <div class="d-flex">
                        <select name="mostrar" id="tipoDocumentoSelect" class="form-select me-2">
                            <!-- Tipo Documento -->
                        </select>
                        <button class="btn bg-primary" id="modalTipoDocumento" type="button">+</button>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/nro-documento.svg" alt="">
                        <label for="nroDocumento" class="form-label">Nro Documento:</label>

                    </div>
                    <input type="number" id="nroDocumento" name="nroDocumento" class="form-control" placeholder="Nro Documento">
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/persona.svg" alt="">
                        <label for="nombreRazonSocial" class="form-label">Nombre / Razón Social:</label>

                    </div>
                    <input type="text" id="nombreRazonSocial" name="nombreRazonSocial" class="form-control" placeholder="Nombre / Razón Social">
                </div>


                <div class="col-7">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/ubicacion.svg" alt="">
                        <label for="direccion" class="form-label">Direccion:</label>

                    </div>
                    <input type="text" id="direccion" class="form-control" placeholder="Direccion">
                </div>
                <div class="col-5">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/telefono.svg" alt="">
                        <label for="telefono" class="form-label">Telefono:</label>

                    </div>
                    <input type="number" id="telefono" class="form-control" placeholder="Telefono">
                </div>
            </div>
            <div class="form-group d-flex justify-content-center ">
                <button id="btnIngresarPersona" class="btn bg-success mt-4">Aceptar</button>
            </div>

        </form>
    </div>
    <!--                                                                    -->
    <!--                  Modal para tipo documento                           -->
    <!--  ================================================================= -->
    <div id="miModalTipoDocumento" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" id="cerrar">&times;</span>
            <form autocomplete="off">
                <div>
                    <label for="tipoDocumento" class="form-label">Tipo Documento:</label>
                    <input type="text" id="tipoDocumento" name="tipoDocumento" class="form-control" placeholder="Tipo Documento">
                </div>
                <div class="form-group d-flex justify-content-center ">
                    <button id="btnSetTipoDocumento" class="btn bg-success mt-4">Aceptar</button>
                </div>

            </form>
            <table class="table table-striped table-bordered" id="tablaTiposDocumentos">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tipo Persona</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Se cargaran los documentos -->
                </tbody>
            </table>
        </div>
    </div>

    <!--                                                                    -->
    <!--                          Buscar                                    -->
    <!--  ================================================================= -->
    <div class="box mt-3">
        <form method="post" autocomplete="off" class="d-grid">
            <p class="col-3 d-flex align-items-center">
                <label class="form-label me-2">Mostrar:</label>
                <select id="mostrarPersonas" class="form-select me-2">
                    <option value="">Seleccionar ...</option>
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <label class="form-label">registros </label>
            </p>
            <div class="col-5"></div>
            <div class="col-4">
                <p class="d-flex align-items-center">
                    <label class="form-label me-2">Buscar:</label>
                    <input type="text" id="buscarPersona" class="form-control">
                </p>
            </div>
        </form>
        <!--                                                                    -->
        <!--                           Mostrar                                  -->
        <!--  ================================================================= -->
        <table class="table table-striped table-bordered" id="tablaPersonas">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Tipo Doc</th>
                    <th>N° Doc</th>
                    <th>Nombres y Apellidos /Razón social</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las categorías se cargarán aquí -->
            </tbody>
        </table>
        <!-- Cantidad de registros mostrados  -->
        <div id="infoRegistros"></div>
        <!-- Paginacion de los registros  -->
        <nav>
            <ul class="pagination"></ul>
        </nav>

    </div>
</div>

<script>
    $(document).ready(function() {
        getTipoDocumento();
        getTipoDocumentoSelect();
        paginaActual = 1;
        getPersona(paginaActual);



        $("#buscarPersona").on("keyup", function() {
            getPersona(1); // Mantiene la misma página al buscar
        });
        //                             
        //                                                Mostrar cantidad de registros 
        // ============================================================================================================
        $("#mostrarPersonas").on("change", function() {
            if ($(this).val() === "") {
                alert("Por favor, selecciona una opción válida.");
            } else {
                paginaActual = 1;
                getPersona(paginaActual); // Mantiene la misma página al cambiar la cantidad
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
    $("#btnSetTipoDocumento").click(function(e) {
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
            }, function(respuesta) {
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
        }, function(respuesta) {
            try {
                const data = JSON.parse(respuesta);
                const tipos_documentos = data.tipos_documentos;

                let html = "";
                tipos_documentos.forEach(function(tiposDocumentos) {
                    html += `
                    <tr class="text-center">
                        <td>${tiposDocumentos.id_tipo_documento}</td>
                        <td>${tiposDocumentos.documento}</td>
                        <td>
                            <button class="btn bg-primary btnEditarTipoDocumento" data-id_tipo_documento="${tiposDocumentos.id_tipo_documento}" data-tipo_documento="${tiposDocumentos.documento}" >Editar</button>
                            <button class="btn bg-danger btnEliminarTipoDocumento" data-id_tipo_documento="${tiposDocumentos.id_tipo_documento}">Eliminar</button>
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
        }, function(respuesta) {
            try {
                const data = JSON.parse(respuesta);
                const tipos_documentos = data.tipos_documentos;

                let html = '<option value="">Seleccionar ...</option>'; // Opcional: con la opción por defecto

                tipos_documentos.forEach(function(tiposDocumentos) {
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
        if (confirm("¿Seguro que deseas eliminar Tipo de Documento?")) {
            $.post("ajax/tipoDocumentoAjax.php", {
                accion: "eliminarTipoDocumento",
                idTipoDocumento: idTipoDocumento
            }, function(respuesta) {
                try {
                    const data = JSON.parse(respuesta);
                    alert(data.message);
                    if (data.status === "success") {
                        getTipoDocumento();
                        getTipoDocumentoSelect();
                    }
                } catch (error) {
                    console.error("Error al procesar la respuesta:", error, respuesta);
                    alert("Error inesperado. Revisa la consola.");
                }
            });
        }

    }

    function updateTipoDocumento() {
        const idTipoDocumento = $(this).data('id_tipo_documento');
        const tipoDocumento = $(this).data('tipo_documento');

        $("#tipoDocumento").val(tipoDocumento);
        $("#btnSetTipoDocumento").text("Actualizar");
        $("#btnSetTipoDocumento").off("click").click(function(e) {
            e.preventDefault();
            $.post("ajax/tipoDocumentoAjax.php", {
                accion: "editarTipoDocumento",
                idTipoDocumento: idTipoDocumento,
                nombre_tipoDocumento: $("#tipoDocumento").val(),

            }, function(respuesta) {
                try {
                    const data = JSON.parse(respuesta);
                    if (data.status === "success") {
                        alert(data.message);
                        getTipoDocumento();
                        limpiarTiposDocumentos()
                        getTipoDocumentoSelect();
                        // Mantiene la misma página después de editar
                        $("#btnSetTipoDocumento").text("Aceptar");
                        $("#btnSetTipoDocumento").off("click").on("click", function(e) {
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
    $("#btnIngresarPersona").click(function(e) {
        e.preventDefault();
        setPersona();
    });


    function setPersona() {

        let tipoDocumentoSelect = $("#tipoDocumentoSelect").val();
        let nroDocumento = $("#nroDocumento").val();
        let nombreRazonSocial = $("#nombreRazonSocial").val();
        let direccion = $("#direccion").val();
        let telefono = $("#telefono").val();

        if (tipoDocumento) {
            $.post("ajax/personaAjax.php", {
                accion: "crearPersona",
                tipoDocumentoSelect: tipoDocumentoSelect,
                nroDocumento: nroDocumento,
                nombreRazonSocial: nombreRazonSocial,
                direccion: direccion,
                telefono: telefono
            }, function(respuesta) {
                try {
                    const data = JSON.parse(respuesta);
                    if (data.status === "success") {
                        alert(data.message);
                        getPersona(paginaActual);

                        limpiarPersona();


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


    function getPersona(paginaPersonas) {
        let mostrarPersonas = $("#mostrarPersonas").val();
        let buscarPersona = $("#buscarPersona").val();

        $.post("ajax/personaAjax.php", {
                accion: "buscarPersona",
                buscarPersona: buscarPersona,
                mostrarPersonas: mostrarPersonas,
                paginaPersonas: paginaPersonas
            },
            function(respuesta) {

                try {
                    const data = respuesta;
                    const personas = data.personas;
                    const total = data.total;
                    const totalPaginas = data.totalPaginas;
                    let html = "";

                    personas.forEach(function(persona) {
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
                                    Editar
                                </button>
                                <button class="btn bg-danger btnEliminarPersona" data-id_persona="${persona.id_persona}">
                                    Eliminar
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
    // $(document).on("click", ".btnEliminarPersona", deletePersona);

    function deletePersona() {
        let idPersona = $(this).data("id_persona");
        console.log(idPersona);
        console.log("Ejecutando  deletePersona...");
        if (confirm("¿Seguro que deseas eliminar a la Persona?")) {
            $.post("ajax/personaAjax.php", {
                accion: "eliminarPersona",
                idPersona: idPersona
            }, function(respuesta) {
                try {
                    let data = JSON.parse(respuesta);
                    alert(data.message);
                    if (data.status === "success") {
                        getPersona(paginaActual);
                    }
                } catch (error) {
                    console.error("Error al procesar la respuesta:", error, respuesta);
                    alert("Error inesperado. Revisa la consola.");
                }
            });
        }
    }

    $(document).on('click', '.btnEditarPersona', updatePersona);

    function updatePersona() {
        console.log("Ejecutando updatePersona...");
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

        console.log("idPersona:", idPersona);
        console.log("documento:", documento);
        console.log("nroDocumento:", nroDocumento);
        console.log("nombreRazonSocial:", nombreRazonSocial);
        console.log("direccion:", direccion);
        console.log("telefono:", telefono);

        $("#btnIngresarPersona").text("Actualizar");
        $("#btnIngresarPersona").off("click").click(function(e) {
            e.preventDefault();
            $.post("ajax/personaAjax.php", {
                accion: "editarPersona",
                idPersona: idPersona,
                documento: $("#tipoDocumentoSelect").val(),
                nroDocumento: $("#nroDocumento").val(),
                nombreRazonSocial: $("#nombreRazonSocial").val(),
                direccion: $("#direccion").val(),
                telefono: $("#telefono").val()

            }, function(respuesta) {
                try {
                    const data = JSON.parse(respuesta);
                    if (data.status === "success") {
                        alert(data.message);
                        getPersona(paginaActual);
                        limpiarPersona();
                        $("#btnIngresarPersona").text("Aceptar");
                        $("#btnIngresarPersona").off("click").on("click", function(e) {
                            e.preventDefault();
                            setPersona();

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

    function limpiarPersona() {


        $("#tipoDocumentoSelect").val("").trigger("change");
        $("#nroDocumento").val("");
        $("#nombreRazonSocial").val("");
        $("#direccion").val("");
        $("#telefono").val("");
    }
</script>