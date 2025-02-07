<?php

require_once "../controllers/tiposDocumentosController.php";
require_once "../models/tiposDocumentosModel.php";

class AjaxTiposDocumentos
{
    public function ajaxIngresarTiposDocumentos()
    {
        if (isset($_POST['tipoDocumento'])) {
            $tipo_documento = $_POST['tipoDocumento'];

            $tiposDocumentos = TiposDocumentosControlador::ctrIngresarTiposDocumentos($tipo_documento);

            echo json_encode($tiposDocumentos, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "error", "message" => "Faltan datos"]);
        }
    }
    public function ajaxMostrarTiposDocumentos()
    {
        $tiposDocumentos = TiposDocumentosControlador::ctrMostrarTiposDocumentos();
        echo json_encode(["tipos_documentos" => $tiposDocumentos], JSON_UNESCAPED_UNICODE);
    }
    public function ajaxEliminarTiposDocumentos()
    {
        try {
            if (isset($_POST['idTipoDocumento'])) {
                $idTipoDocumento = $_POST['idTipoDocumento'];

                $tiposDocumentos = TiposDocumentosControlador::ctrEliminarTiposPersonas($idTipoDocumento);

                // Asegúrate de enviar solo JSON
                echo json_encode($tiposDocumentos, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["status" => "error", "message" => "Faltan datos para eliminar"]);
            }
        } catch (Exception $e) {
            // Atrapa y envía cualquier error como respuesta JSON
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
    public function ajaxEditarTiposDocumentos()
    {
        try {
            if (isset($_POST['idTipoDocumento'])) {
                $idTipoDocumento = $_POST['idTipoDocumento'];
                $nombre_tipoDocumento = $_POST['nombre_tipoDocumento'];
                $tiposDocumentos = TiposDocumentosControlador::ctrEditarTiposDocumentos($idTipoDocumento, $nombre_tipoDocumento);

                // Asegúrate de enviar solo JSON
                echo json_encode($tiposDocumentos, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["status" => "error", "message" => "Faltan datos para editar"]);
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
    $tiposDocumentos = new AjaxTiposDocumentos();

    if ($accion == "crearTipoDocumento") {
        $tiposDocumentos->ajaxIngresarTiposDocumentos();
    } elseif ($accion == "mostrarTipoDocumento") {
        $tiposDocumentos->ajaxMostrarTiposDocumentos();
    } elseif ($accion == "eliminarTipoDocumento") {
        $tiposDocumentos->ajaxEliminarTiposDocumentos();
    } elseif ($accion == "editarTipoDocumento") {
        $tiposDocumentos->ajaxEditarTiposDocumentos();
    }
}
