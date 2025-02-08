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
}
