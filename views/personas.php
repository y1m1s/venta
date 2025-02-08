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
                            <option value="">Seleccionar ...</option>
                        </select>

                        <button class="btn bg-primary" id="modalTipoDocumento" type="button">+</button>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/nro-documento.svg" alt="">
                        <label for="nombre" class="form-label">Nro Documento:</label>

                    </div>
                    <input type="number" id="nombre" name="nombre" class="form-control" placeholder="Nro Documento">
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/persona.svg" alt="">
                        <label for="descripcion" class="form-label">Nombre / Razón Social:</label>

                    </div>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Nombre / Razón Social">
                </div>


                <div class="col-7">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/ubicacion.svg" alt="">
                        <label for="descripcion" class="form-label">Direccion:</label>

                    </div>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Direccion">
                </div>
                <div class="col-5">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/telefono.svg" alt="">
                        <label for="descripcion" class="form-label">Telefono:</label>

                    </div>
                    <input type="number" id="descripcion" name="descripcion" class="form-control" placeholder="Telefono">
                </div>
            </div>
            <div class="form-group d-flex justify-content-center ">
                <button id="btnIngresar" class="btn bg-success mt-4">Aceptar</button>
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
                <select name="mostrar" id="mostrar" class="form-select me-2">
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
                    <input type="text" name="campo" id="campo" class="form-control">
                </p>
            </div>
        </form>
        <!--                                                                    -->
        <!--                           Mostrar                                  -->
        <!--  ================================================================= -->
        <table class="table table-striped table-bordered" id="tablaCategorias">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
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

                        });
                    } else {
                        alert(data.message);
                    }
                } catch (error) {
                    console.error("Error al procesar la respuesta eliminar:", error, respuesta);
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



</script>