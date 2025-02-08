<?php


class PersonaControlador
{
    static public function ctrSetPersona($tipoDocumentoSelect, $nroDocumento, $nombreRazonSocial, $direccion, $telefono)
    {
        $persona = PersonaModelo::mdlSetPersona($tipoDocumentoSelect, $nroDocumento, $nombreRazonSocial, $direccion, $telefono);
        return $persona;
    }
}
