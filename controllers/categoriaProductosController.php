<?php

class CategoriaProductosControlador
{
    static public function ctrIngresarCategoriaProductos($nombre_categoria, $descripcion_categoria)
    {
        $categoriaProductos = CategoriaProductosModelo::mdlIngresarCategoriaProductos($nombre_categoria, $descripcion_categoria);
        return $categoriaProductos;
    }


    static public function ctrEditarCategoriaProductos($id, $nombre, $descripcion)
    {
        if ($id && $nombre || $descripcion) {
            return CategoriaProductosModelo::mdlEditarCategoriaProductos($id, $nombre, $descripcion);
        } else {
            return ["status" => "error", "message" => "Datos inválidos para editar"];
        }
    }


    static public function ctrEliminarCategoriaProductos($id)
    {
        if ($id) {
            return CategoriaProductosModelo::mdlEliminarCategoriaProductos($id);
        } else {
            return ["status" => "error", "message" => "ID no válido"];
        }
    }

    static public function ctrBuscarCategorias($campo, $mostrar, $pagina)
    {
        $campo = trim($campo);
        $mostrar = $mostrar ?: 7;
        $pagina = $pagina ?: 1;

        return CategoriaProductosModelo::mdlBuscarCategorias($campo, $mostrar, $pagina);
    }
}
