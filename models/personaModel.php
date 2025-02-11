<?php
require_once "conexion.php";

class PersonaModelo
{

    static public function mdlSetPersona($tipoDocumentoSelect, $nroDocumento, $nombreRazonSocial, $direccion, $telefono)
    {
        $stmt = Conexion::conexion()->prepare("insert into personas (nro_documento,nombre_razon_social,direccion,telefono,fk_id_tipo_documento) values(:nro_documento,:nombreRazonSocial,:direccion,:telefono,:tipoDocumento)");
        $stmt->bindParam(":nro_documento", $nroDocumento, PDO::PARAM_INT);
        $stmt->bindParam(":nombreRazonSocial", $nombreRazonSocial, PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $stmt->bindParam(":tipoDocumento", $tipoDocumentoSelect, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Persona Ingresada Correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al ingresar la persona"];
        }
    }
    static public function mdlGetPersona($buscarPersona, $mostrarPersonas, $paginaPersonas)
    {
        $paginaPersonas = $paginaPersonas ? (int)$paginaPersonas : 1;
        $mostrarPersonas = $mostrarPersonas ? (int)$mostrarPersonas : 5;
        $inicio = ($paginaPersonas - 1) * $mostrarPersonas;

        try {
            $conexion = Conexion::conexion();

            // Obtener total de registros
            $totalPersonaQuery = $conexion->prepare("
                SELECT COUNT(*) AS total
                FROM personas
                WHERE nombre_razon_social LIKE :buscarPersona OR nro_documento LIKE :buscarPersona
            ");
            $totalPersonaQuery->bindValue(":buscarPersona", "%" . $buscarPersona . "%", PDO::PARAM_STR);
            $totalPersonaQuery->execute();
            $totalPersonas = $totalPersonaQuery->fetch(PDO::FETCH_ASSOC)["total"];

            // Obtener datos paginados
            $stmt = $conexion->prepare("
                SELECT personas.id_persona, tipos_documentos.documento, personas.nro_documento, personas.nombre_razon_social, personas.direccion, personas.telefono
                FROM personas
                INNER JOIN tipos_documentos ON personas.fk_id_tipo_documento = tipos_documentos.id_tipo_documento
                WHERE personas.nombre_razon_social LIKE :buscarPersona OR personas.nro_documento LIKE :buscarPersona
                ORDER BY personas.id_persona ASC
                LIMIT :inicio, :mostrarPersonas
            ");

            $stmt->bindValue(":buscarPersona", "%" . $buscarPersona . "%", PDO::PARAM_STR);
            $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
            $stmt->bindValue(":mostrarPersonas", $mostrarPersonas, PDO::PARAM_INT);
            $stmt->execute();

            $personas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                "personas" => $personas,
                "total" => $totalPersonas,
                "paginaActual" => $paginaPersonas,
                "totalPaginas" => ceil($totalPersonas / $mostrarPersonas)
            ];
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }
    static public function mdlDeletePersona($idPersona)
    {

        $stmt = Conexion::conexion()->prepare("DELETE FROM personas WHERE id_persona =:idPersona");
        $stmt->bindParam(":idPersona", $idPersona, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Tipo de Persona eliminado correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al eliminar el Tipo de Persona"];
        }
    }
}
