<div class="box-title">
    <h1>Proveedor</h1>
</div>
<div class="d-grid box">
    <!--                                                                    -->
    <!--                           Ingresar Datos                           -->
    <!--  ================================================================= -->
    <div class="box col-4 height-250">
        <form autocomplete="off">
            <div>
                <label for="nombre" class="form-label">Nombres y Apellidos:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu categoria de productos">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingresa una descripcion de productos">
            </div>
            <div class="form-group d-flex justify-content-center ">
                <button id="btnIngresar" class="btn bg-success mt-4">Aceptar</button>
            </div>

        </form>
    </div>
    <!-- Caja sin uso para crear un espacio en medio  -->
    <div class="col-1"></div>
    <!--                                                                    -->
    <!--                          Buscar                                    -->
    <!--  ================================================================= -->
    <div class="box col-7">
        <form method="post" autocomplete="off" class="d-grid">
            <p class="col-7 d-flex align-items-center">
                <label class="form-label me-2">Mostrar :</label>
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
            <div class="col-5">
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
        paginaActual = 1;

        buscarCategoria(paginaActual); // Llamada inicial para cargar las categorías

        //                             
        //                                                Ingresar
        // ============================================================================================================
        $("#btnIngresar").click(function(e) {
            e.preventDefault();
            const nombre = $("#nombre").val();
            const descripcion = $("#descripcion").val();

            if (nombre && descripcion) {
                $.post("ajax/categoriaProductosAjax.php", {
                    accion: "crear",
                    nombre: nombre,
                    descripcion: descripcion,
                }, function(respuesta) {
                    try {
                        const data = JSON.parse(respuesta);
                        if (data.status === "success") {
                            alert(data.message);
                            buscarCategoria(paginaActual); // Mantiene la misma página después de agregar
                            limpiarCampos();
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
        });
        //                             
        //                                                Editar
        // ============================================================================================================
        $(document).on('click', '.btnEditar', function() {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const descripcion = $(this).data('descripcion');

            $("#nombre").val(nombre);
            $("#descripcion").val(descripcion);

            // Cambiar el botón a "Actualizar"
            $("#btnIngresar").text("Actualizar");
            $("#btnIngresar").off("click").click(function(e) {
                e.preventDefault();
                $.post("ajax/categoriaProductosAjax.php", {
                    accion: "editar",
                    id: id,
                    nombre_categoria: $("#nombre").val(),
                    descripcion_categoria: $("#descripcion").val()
                }, function(respuesta) {
                    try {
                        const data = JSON.parse(respuesta);
                        if (data.status === "success") {
                            alert(data.message);
                            buscarCategoria(paginaActual);
                            limpiarCampos();
                            // Mantiene la misma página después de editar
                            $("#btnIngresar").text("Aceptar");
                            $("#btnIngresar").off("click").on("click", function(e) {
                                e.preventDefault();

                                // Reasigna el evento original para "Aceptar"
                            });
                        } else {
                            alert(data.message);
                        }
                    } catch (error) {
                        console.error("Error al procesar la respuesta:", error, respuesta);
                    }
                });
            });
        });
        //                             
        //                                                Eliminar
        // ============================================================================================================
        $(document).on('click', '.btnEliminar', function() {
            const id = $(this).data('id');
            if (confirm("¿Seguro que deseas eliminar esta categoría?")) {
                $.post("ajax/categoriaProductosAjax.php", {
                    accion: "eliminar",
                    id: id
                }, function(respuesta) {
                    try {
                        const data = JSON.parse(respuesta);
                        alert(data.message);
                        if (data.status === "success") {
                            buscarCategoria(paginaActual);
                        }
                    } catch (error) {
                        console.error("Error al procesar la respuesta:", error, respuesta);
                        alert("Error inesperado. Revisa la consola.");
                    }
                });
            }
        });

        //                             
        //                                                Buscar en tiempo real
        // ============================================================================================================
        $("#campo").on("keyup", function() {
            buscarCategoria(1); // Mantiene la misma página al buscar
        });
        //                             
        //                                                Mostrar cantidad de registros 
        // ============================================================================================================
        $("#mostrar").on("change", function() {
            if ($(this).val() === "") {
                alert("Por favor, selecciona una opción válida.");
            } else {
                paginaActual = 1;
                buscarCategoria(paginaActual); // Mantiene la misma página al cambiar la cantidad
            }
        });


    });
    //                             
    //                                                Mostrar buscar 
    // ============================================================================================================
    function buscarCategoria(pagina) {

        let mostrar = $("#mostrar").val() || 5; // Mostrar por defecto 5 datos 
        let campo = $("#campo").val();

        $.post("ajax/categoriaProductosAjax.php", {
            accion: "buscar",
            campo: campo,
            mostrar: mostrar,
            pagina: pagina
        }, function(respuesta) {
            try {

                const data = JSON.parse(respuesta);
                const categorias = data.categorias;
                const total = data.total;
                const totalPaginas = data.totalPaginas;

                let html = "";
                categorias.forEach(function(categoria) {
                    html += `
                    <tr class="text-center">
                        <td>${categoria.id_categoria}</td>
                        <td>${categoria.categoria}</td>
                        <td>${categoria.descripcion_categoria}</td>
                        <td>
                            <button class="btn bg-primary btnEditar" data-id="${categoria.id_categoria}" data-nombre="${categoria.nombre_categoria}" data-descripcion="${categoria.descripcion_categoria}">Editar</button>
                            <button class="btn bg-danger btnEliminar" data-id="${categoria.id_categoria}">Eliminar</button>
                        </td>
                    </tr>
                `;
                });
                $("#tablaCategorias tbody").html(html);

                // Mostrar información de registros
                $("#infoRegistros").text(`Mostrando ${categorias.length} de ${total} registros`);

                // Generar botones de paginación
                let paginacionHtml = "";
                for (let i = 1; i <= totalPaginas; i++) {
                    paginacionHtml += `
                    <li class="page-item ${i === pagina ? 'active' : ''}">
                        <a href="#" class="page-link" onclick="paginaActual = ${i}; buscarCategoria(${i}); return false;">${i}</a>
                    </li>
                    `;
                }

                $(".pagination").html(paginacionHtml);
            } catch (error) {
                console.error("Error al procesar los datos:", error, respuesta);
            }
        });
        paginaActual = pagina;
    }




    //                             
    //                              Funcion para limpiar los campos del formualario
    // =================================================================================================
    function limpiarCampos() {
        $("#nombre").val("");
        $("#descripcion").val("");
    }
</script>