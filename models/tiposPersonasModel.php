<?php
require_once "conexion.php";

class TiposPersonasModelo
{
    // Método para insertar una categoría
    static public function mdlIngresarTiposPersonas($categoria)
    {
        $stmt = Conexion::conexion()->prepare("INSERT INTO tipos_personas (persona) VALUES (:persona)");

        $stmt->bindParam(":persona", $categoria, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Tipo Persona ingresada correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al ingresar Tipo Persona "];
        }
    }

    public static function mdlMostrarTiposPersonas()
    {
        // Suponiendo que tienes una conexión a la base de datos en $db
        $stmt = Conexion::conexion()->prepare("SELECT id_tipo_persona, persona FROM tipos_personas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve todos los tipos de personas
    }
    public static function mdlEliminarTiposPersonas($idTipoPersona)
    {
        try {
            // Preparar la consulta SQL para eliminar el registro
            $stmt = Conexion::conexion()->prepare("DELETE FROM tipos_personas WHERE id_tipo_persona = :id");
            $stmt->bindParam(":id", $idTipoPersona, PDO::PARAM_INT);

            // Ejecutar la consulta y verificar si se ejecutó correctamente
            if ($stmt->execute()) {
                return ["status" => "success", "message" => "Tipo de Persona eliminado correctamente"];
            } else {
                return ["status" => "error", "message" => "Error al eliminar el Tipo de Persona"];
            }
        } catch (PDOException $e) {
            // Manejar cualquier excepción y retornar el mensaje de error
            return ["status" => "error", "message" => "Error: " . $e->getMessage()];
        }
    }
    public static function mdlEditarTiposPersonas($idTipoPersona, $nombre_tipoPersona)
    {

        try {
            $stmt = Conexion::conexion()->prepare("UPDATE tipos_personas SET persona = :nombre WHERE id_tipo_persona = :id");
            $stmt->bindParam(":id", $idTipoPersona, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre_tipoPersona, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ["status" => "success", "message" => "Tipo Persona actualizado correctamente"];
            } else {
                return ["status" => "error", "message" => "Error al actualizar Tipo Persona"];
            }
        } catch (PDOException $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }
}
