<?php
require_once "conexion.php";

class TiposDocumentosModelo
{
    // Método para insertar una categoría
    static public function mdlIngresarTiposDocumentos($tipo_documento)
    {
        $stmt = Conexion::conexion()->prepare("INSERT INTO tipos_documentos (documento) VALUES (:documento)");

        $stmt->bindParam(":documento", $tipo_documento, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Tipo Documento Ingresado correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al ingresar Tipo documento"];
        }
    }

    public static function mdlMostrarTiposDocumentos()
    {
        // Suponiendo que tienes una conexión a la base de datos en $db
        $stmt = Conexion::conexion()->prepare("SELECT id_tipo_documento, documento FROM tipos_documentos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve todos los tipos de personas
    }
    public static function mdlEliminarTiposPersonas($idTipoDocumento)
    {
        try {
            // Preparar la consulta SQL para eliminar el registro
            $stmt = Conexion::conexion()->prepare("DELETE FROM tipos_documentos WHERE id_tipo_documento = :id");
            $stmt->bindParam(":id", $idTipoDocumento, PDO::PARAM_INT);

            // Ejecutar la consulta y verificar si se ejecutó correctamente
            if ($stmt->execute()) {
                return ["status" => "success", "message" => "Tipo de documento eliminado correctamente"];
            } else {
                return ["status" => "error", "message" => "Error al eliminar el Tipo de Documento"];
            }
        } catch (PDOException $e) {
            // Manejar cualquier excepción y retornar el mensaje de error
            return ["status" => "error", "message" => "Error: " . $e->getMessage()];
        }
    }
    public static function mdlEditarTiposDocumentos($idTipoDocumento, $nombre_tipoDocumento)
    {

        try {
            $stmt = Conexion::conexion()->prepare("UPDATE tipos_documentos SET documento = :nombre WHERE id_tipo_documento = :id");
            $stmt->bindParam(":id", $idTipoDocumento, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre_tipoDocumento, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ["status" => "success", "message" => "Tipo Documento actualizado correctamente"];
            } else {
                return ["status" => "error", "message" => "Error al actualizar Tipo Documento"];
            }
        } catch (PDOException $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }
}
