<?php

class TiposPersonasControlador
{
    static public function ctrIngresarTiposPersonas($tipo_persona)
    {
        $tiposPersonas = TiposPersonasModelo::mdlIngresarTiposPersonas($tipo_persona);
        return $tiposPersonas;
    }
    static public function ctrMostrarTiposPersonas()
    {
        $tiposPersonas = TiposPersonasModelo::mdlMostrarTiposPersonas();
        return $tiposPersonas;
    }
    static public function ctrEliminarTiposPersonas($idTipoPersona)
    {
        $tiposPersonas = TiposPersonasModelo::mdlEliminarTiposPersonas($idTipoPersona);
        return $tiposPersonas;
    }
    static public function ctrEditarTiposPersonas($idTipoPersona, $nombre_tipoPersona)
    {
        $tiposPersonas = TiposPersonasModelo::mdlEditarTiposPersonas($idTipoPersona, $nombre_tipoPersona);
        return $tiposPersonas;
    }
}
