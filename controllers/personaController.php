<?php


class PersonaControlador
{
    static public function ctrSetPersona($tipoDocumentoSelect, $nroDocumento, $nombreRazonSocial, $direccion, $telefono)
    {
        $persona = PersonaModelo::mdlSetPersona($tipoDocumentoSelect, $nroDocumento, $nombreRazonSocial, $direccion, $telefono);
        return $persona;
    }
    static public function ctrGetPersona($buscarPersona, $mostrarPersonas, $paginaPersonas)
    {
        return PersonaModelo::mdlGetPersona($buscarPersona, $mostrarPersonas, $paginaPersonas);
    }
    static public function ctrDeletePersona($idPersona)
    {

        if ($idPersona) {
            return PersonaModelo::mdlDeletePersona($idPersona);
        } else {
            return ["status" => "error", "message" => "ID no válido"];
        }
   
    }
}
