<?php

require_once "../controllers/personaController.php";
require_once "../models/personaModel.php";

class AjaxPersona
{

    public function ajaxSetPersonas()
    {
        if (
            !empty($_POST["tipoDocumentoSelect"]) &&
            !empty($_POST["nroDocumento"]) &&
            !empty($_POST["nombreRazonSocial"]) &&
            !empty($_POST["direccion"]) &&
            isset($_POST["telefono"])
        ) {
            $tipoDocumentoSelect = $_POST["tipoDocumentoSelect"];
            $nroDocumento = $_POST["nroDocumento"];
            $nombreRazonSocial = $_POST["nombreRazonSocial"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];

            $respuesta = PersonaControlador::ctrSetPersona($tipoDocumentoSelect, $nroDocumento, $nombreRazonSocial, $direccion, $telefono);
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "error", "message" => "Faltan datos"]);
        }
    }
}

if (isset($_POST["accion"])) {

    $accion = $_POST["accion"];
    $persona = new AjaxPersona();

    if ($accion == "crearPersona") {
        $persona->ajaxSetPersonas();
    }
}
