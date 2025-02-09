<?php
require_once "conexion.php";

class CategoriaProductosModelo
{
    // Método para insertar una categoría
    static public function mdlIngresarCategoriaProductos($categoria, $descripcion)
    {
        $stmt = Conexion::conexion()->prepare("INSERT INTO categorias (categoria, descripcion) VALUES (:categoria, :descripcion)");

        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Categoría ingresada correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al ingresar categoría"];
        }
    }



    // Método para editar una categoría
    static public function mdlEditarCategoriaProductos($id, $nombre, $descripcion)
    {
        try {
            $stmt = Conexion::conexion()->prepare("UPDATE categorias SET categoria = :nombre, descripcion = :descripcion WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ["status" => "success", "message" => "Categoría actualizada correctamente"];
            } else {
                return ["status" => "error", "message" => "Error al actualizar la categoría"];
            }
        } catch (PDOException $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }


    // Método para eliminar una categoría
    static public function mdlEliminarCategoriaProductos($id)
    {
        try {
            $stmt = Conexion::conexion()->prepare("DELETE FROM categorias WHERE id_categoria = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ["status" => "success", "message" => "Categoría eliminada correctamente"];
            } else {
                return ["status" => "error", "message" => "Error al eliminar la categoría"];
            }
        } catch (PDOException $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }
    // Modelo para busqueda 
    static public function mdlBuscarCategorias($campo, $mostrar, $pagina)
    {
        $pagina = $pagina ? (int)$pagina : 1; // Página por defecto
        $mostrar = $mostrar ? (int)$mostrar : 7; // Filas por página por defecto
        $inicio = ($pagina - 1) * $mostrar;

        try {
            $conexion = Conexion::conexion();

            // Obtener total de registros que cumplen con la búsqueda
            $totalQuery = $conexion->prepare("
            SELECT COUNT(*) AS total 
            FROM categorias 
            WHERE categoria LIKE :campo OR descripcion LIKE :campo
            ");
            $totalQuery->bindValue(":campo", '%' . $campo . '%', PDO::PARAM_STR);
            $totalQuery->execute();
            $total = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];

            // Obtener los registros paginados
            $stmt = $conexion->prepare("
            SELECT id_categoria, categoria, descripcion
            FROM categorias 
            WHERE categoria LIKE :campo OR descripcion LIKE :campo 
            ORDER BY id_categoria ASC 
            LIMIT :inicio, :mostrar
            ");
            $stmt->bindValue(":campo", '%' . $campo . '%', PDO::PARAM_STR);
            $stmt->bindValue(":inicio", (int)$inicio, PDO::PARAM_INT);
            $stmt->bindValue(":mostrar", (int)$mostrar, PDO::PARAM_INT);
            $stmt->execute();
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                "categorias" => $categorias,
                "total" => $total,
                "paginaActual" => $pagina,
                "totalPaginas" => ceil($total / $mostrar)
            ];
        } catch (PDOException $e) {
            return [];
        }
    }
}
