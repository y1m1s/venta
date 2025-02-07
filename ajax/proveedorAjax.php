<?php

require_once "../controllers/categoriaProductosController.php";
require_once "../models/categoriaProductosModel.php";

class AjaxCategoriaProductos
{
    // Método para ingresar una categoría de producto
    public function ajaxIngresarCategoriaProductos()
    {
        if (isset($_POST['nombre']) && isset($_POST['telefono'])) {
            $nombre_proveedor = $_POST['nombre'];  // El nombre de la categoría
            $telefono = $_POST['nombre'];  // El nombre de la categoría
            $correo = $_POST['nombre'];  // El nombre de la categoría
            $direccion = $_POST['descripcion'];  // La descripción de la categoría

            // Llamada al controlador para insertar la categoría
            $categoriaProductos = CategoriaProductosControlador::ctrIngresarCategoriaProductos($nombre_proveedor, $telefono, $correo, $direccion);

            // Responder con el resultado en formato JSON
            echo json_encode($categoriaProductos, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "error", "message" => "Faltan datos"]);
        }
    }

    // Método para leer todas las categorías
    public function ajaxLeerCategorias()
    {
        $categorias = CategoriaProductosControlador::ctrLeerCategorias();
        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }

    // Método para editar una categoría
    public function ajaxEditarCategoriaProductos()
    {
        try {
            if (isset($_POST['id'], $_POST['nombre_categoria'], $_POST['descripcion_categoria'])) {
                $id = $_POST['id'];
                $nombre = $_POST['nombre_categoria'];
                $descripcion = $_POST['descripcion_categoria'];

                $respuesta = CategoriaProductosControlador::ctrEditarCategoriaProductos($id, $nombre, $descripcion);

                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["status" => "error", "message" => "Faltan datos para editar"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }


    // Método para eliminar una categoría
    public function ajaxEliminarCategoriaProductos()
    {
        try {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                $categoriaProductos = CategoriaProductosControlador::ctrEliminarCategoriaProductos($id);

                // Asegúrate de enviar solo JSON
                echo json_encode($categoriaProductos, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["status" => "error", "message" => "Faltan datos para eliminar"]);
            }
        } catch (Exception $e) {
            // Atrapa y envía cualquier error como respuesta JSON
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}

// Verificar si se ha recibido la acción para ejecutar
if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];
    $categorias = new AjaxCategoriaProductos();

    if ($accion == "crear") {
        $categorias->ajaxIngresarCategoriaProductos();
    } elseif ($accion == "leer") {
        $categorias->ajaxLeerCategorias();
    } elseif ($accion == "editar") {
        $categorias->ajaxEditarCategoriaProductos();
    } elseif ($accion == "eliminar") {
        $categorias->ajaxEliminarCategoriaProductos();
    }
}
