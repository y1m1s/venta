$(document).ready(function () {
    paginaActual = 1;
    buscarCategoria(paginaActual);
    let $nombre = $("#nombre");
    let errorCategoria = $("#errorCategoria");

    $nombre.on("input", function () {
        if ($(this).val().trim() !== "") {
            errorCategoria.html("");
            $(this).removeClass("error-campo-focus");
        }
    });

    // Ingresar Categoria
    $("#btnIngresar").click(function (e) {
        e.preventDefault();
        setCategoria();
    });
    // Editar Categoria
    $(document).off("click", ".btnEditar").on("click", ".btnEditar", updateCategoria);
    // Eliminar Categoria
    $(document).off("click", ".btnEliminar").on("click", ".btnEliminar", deleteCategoria);
    // Buscar Categoria
    $("#campo").on("keyup", function () {
        buscarCategoria(1);
    });
    // Cantidad Mostrar Categorias 
    $("#mostrar").on("change", function () {
        if ($(this).val() === "") {
            alert("Por favor, selecciona una opción válida.");
        } else {
            paginaActual = 1;
            buscarCategoria(paginaActual);
        }
    });
    $("#btnGenerarPDF").click(function (e) {
        e.preventDefault();
        window.open("../models/reportePDFCategoria.php", "_blank");
    });
});
/*
============================================================================================================
|                                               Funciones                                                  |
============================================================================================================
*/
function updateCategoria() {
    const id = $(this).data('id');
    const nombre = $(this).data('nombre');
    const descripcion = $(this).data('descripcion');

    $("#nombre").val(nombre);
    $("#descripcion").val(descripcion);

    // Cambiar el botón a "Actualizar"
    $("#btnIngresar").text("Actualizar");
    $("#btnIngresar").off("click").click(function (e) {
        e.preventDefault();
        $.post("ajax/categoriaProductosAjax.php", {
            accion: "editar",
            id: id,
            nombre_categoria: $("#nombre").val(),
            descripcion_categoria: $("#descripcion").val()
        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                if (data.status === "success") {
                    alert(data.message);
                    buscarCategoria(paginaActual);
                    limpiarCampos();
                    $("#btnIngresar").text("Aceptar");
                    $("#btnIngresar").off("click").on("click", function (e) {
                        e.preventDefault();
                        setCategoria();

                    });
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
            }
        });
    });
}

function deleteCategoria() {
    const id = $(this).data("id");

    ModalConfirm.confirmarConCancelar("¿Seguro que deseas eliminar esta categoría?", function () {
        $.post("ajax/categoriaProductosAjax.php", {
            accion: "eliminar",
            id: id
        }, function (respuesta) {
            try {
                const data = JSON.parse(respuesta);
                ModalConfirm.confirmarSoloAceptar(data.message);

                if (data.status === "success") {
                    buscarCategoria(paginaActual);
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
                alert("Error inesperado. Revisa la consola.");
            }
        });
    });
}


function setCategoria() {
    let $nombre = $("#nombre");
    let nombre = $nombre.val().trim();
    let errorCategoria = $("#errorCategoria");
    let descripcion = $("#descripcion").val().trim();
    let mensajeError = "Por favor ingresa una categoría!!!";

    if (nombre === "") {
        console.log("Falta Categoria");
        $nombre.focus().addClass("error-campo-focus");
        errorCategoria.html(mensajeError);
    } else {
        $.post("ajax/categoriaProductosAjax.php", {
            accion: "crear",
            nombre: nombre,
            descripcion: descripcion,
        }, function (respuesta) {
            try {
                if (!respuesta) throw new Error("Respuesta vacía del servidor");

                const data = JSON.parse(respuesta);
                ModalConfirm.confirmarSoloAceptar(data.message);


                if (data.status === "success") {
                    buscarCategoria(paginaActual);
                    errorCategoria.html("");
                    limpiarCampos();
                }
            } catch (error) {
                console.error("Error al procesar la respuesta:", error, respuesta);
            }
        });
    }
}

function buscarCategoria(pagina) {

    let mostrar = $("#mostrar").val() || 5;
    let campo = $("#campo").val();

    $.post("ajax/categoriaProductosAjax.php", {
        accion: "buscar",
        campo: campo,
        mostrar: mostrar,
        pagina: pagina
    }, function (respuesta) {
        try {

            const data = JSON.parse(respuesta);
            const categorias = data.categorias;
            const total = data.total;
            const totalPaginas = data.totalPaginas;

            let html = "";
            categorias.forEach(function (categoria) {
                html += `
                <tr class="text-center">
                    <td>${categoria.id_categoria}</td>
                    <td>${categoria.categoria}</td>
                    <td>${categoria.descripcion}</td>
                    <td>
                        <button  type="button" class="btn bg-primary btnEditar" data-id="${categoria.id_categoria}" data-nombre="${categoria.categoria}" data-descripcion="${categoria.descripcion}">                    <img src="views/assets/img/editar.svg" alt="">
</button>
                        <button type="button" class="btn bg-danger btnEliminar" data-id="${categoria.id_categoria}">                    <img src="views/assets/img/eliminar.svg" alt="">
</button>
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

function limpiarCampos() {
    $("#nombre").val("");
    $("#descripcion").val("");
}