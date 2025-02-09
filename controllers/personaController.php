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
}
