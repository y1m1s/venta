<?php

class TiposDocumentosControlador
{
    static public function ctrIngresarTiposDocumentos($tipo_documento)
    {
        $tiposDocumentos = TiposDocumentosModelo::mdlIngresarTiposDocumentos($tipo_documento);
        return $tiposDocumentos;
    }
    static public function ctrMostrarTiposDocumentos()
    {
        $tiposDocumentos = TiposDocumentosModelo::mdlMostrarTiposDocumentos();
        return $tiposDocumentos;
    }
    static public function ctrEliminarTiposPersonas($idTipoDocumento)
    {
        $tiposPersonas = TiposDocumentosModelo::mdlEliminarTiposPersonas($idTipoDocumento);
        return $tiposPersonas;
    }
    static public function ctrEditarTiposDocumentos($idTipoDocumento, $nombre_tipoDocumento)
    {
        $tiposPersonas = TiposDocumentosModelo::mdlEditarTiposDocumentos($idTipoDocumento, $nombre_tipoDocumento);
        return $tiposPersonas;
    }
}
