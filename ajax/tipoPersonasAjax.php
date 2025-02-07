<?php

require_once "../controllers/tiposPersonasController.php";
require_once "../models/tiposPersonasModel.php";

class AjaxTiposPersonas
{
    public function ajaxIngresarTiposPersonas()
    {
        if (isset($_POST['tipoPersona'])) {
            $tipo_persona = $_POST['tipoPersona'];

            $tiposPersonas = TiposPersonasControlador::ctrIngresarTiposPersonas($tipo_persona);

            echo json_encode($tiposPersonas, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["status" => "error", "message" => "Faltan datos"]);
        }
    }
    public function ajaxMostrarTiposPersonas()
    {
        $tiposPersonas = TiposPersonasControlador::ctrMostrarTiposPersonas();
        echo json_encode(["tipos_personas" => $tiposPersonas], JSON_UNESCAPED_UNICODE);
    }
    public function ajaxEliminarTiposPersonas()
    {
        try {
            if (isset($_POST['idTipoPersona'])) {
                $idTipoPersona = $_POST['idTipoPersona'];

                $tiposPersonas = TiposPersonasControlador::ctrEliminarTiposPersonas($idTipoPersona);

                // Asegúrate de enviar solo JSON
                echo json_encode($tiposPersonas, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["status" => "error", "message" => "Faltan datos para eliminar"]);
            }
        } catch (Exception $e) {
            // Atrapa y envía cualquier error como respuesta JSON
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
    public function ajaxEditarTiposPersonas()
    {
        try {
            if (isset($_POST['idTipoPersona'])) {
                $idTipoPersona = $_POST['idTipoPersona'];
                $nombre_tipoPersona = $_POST['nombre_tipoPersona'];
                $categoriaProductos = TiposPersonasControlador::ctrEditarTiposPersonas($idTipoPersona, $nombre_tipoPersona );

                // Asegúrate de enviar solo JSON
                echo json_encode($categoriaProductos, JSON_UNESCAPED_UNICODE);
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
    $tiposPersonas = new AjaxTiposPersonas();

    if ($accion == "crearTipoPersona") {
        $tiposPersonas->ajaxIngresarTiposPersonas();
    } elseif ($accion == "mostrarTipoPersona") {
        $tiposPersonas->ajaxMostrarTiposPersonas();
    } elseif ($accion == "eliminarTipoPersona") {
        $tiposPersonas->ajaxEliminarTiposPersonas();
    } elseif ($accion == "editarTipoPersona") {
        $tiposPersonas->ajaxEditarTiposPersonas();
    }
}
