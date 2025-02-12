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
    public function ajaxGetPersonas()
    {
        $buscarPersona = isset($_POST["buscarPersona"]) ? $_POST["buscarPersona"] : "";
        $mostrarPersonas = isset($_POST["mostrarPersonas"]) ? $_POST["mostrarPersonas"] : 5;
        $paginaPersonas = isset($_POST["paginaPersonas"]) ? $_POST["paginaPersonas"] : 1;

        $personas = PersonaControlador::ctrGetPerSona($buscarPersona, $mostrarPersonas, $paginaPersonas);

        // Asegurar que siempre se devuelve un JSON válido
        header('Content-Type: application/json');
        echo json_encode($personas, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxDeletePersonas()
    {
        if (isset($_POST["idPersona"])) {
            $idPersona = $_POST["idPersona"];
            $persona = PersonaControlador::ctrDeletePersona($idPersona);
            echo json_encode($persona, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "error", "message" => "ID no proporcionado"], JSON_UNESCAPED_UNICODE);
        }
    }
    public function ajaxUpdatePersona()
    {
        if (
            !empty($_POST["idPersona"]) &&
            !empty($_POST["documento"]) &&
            !empty($_POST["nroDocumento"]) &&
            !empty($_POST["nombreRazonSocial"]) &&
            !empty($_POST["telefono"]) &&
            isset($_POST["direccion"])

        ) {
            $idPersona = $_POST["idPersona"];
            $documento = $_POST["documento"];
            $nroDocumento = $_POST["nroDocumento"];
            $nombreRazonSocial = $_POST["nombreRazonSocial"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
        }
        $persona = PersonaControlador::ctrUpdatePersona($idPersona, $documento, $nroDocumento, $nombreRazonSocial, $direccion,  $telefono);
        echo json_encode($persona, JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_POST["accion"])) {

    $accion = $_POST["accion"];
    $persona = new AjaxPersona();

    if ($accion == "crearPersona") {
        $persona->ajaxSetPersonas();
    } elseif ($accion == "buscarPersona") {
        $persona->ajaxGetPersonas();
    } elseif ($accion == "eliminarPersona") {
        $persona->ajaxDeletePersonas();
    } elseif ($accion == "editarPersona") {
        $persona->ajaxUpdatePersona();
    }
}
