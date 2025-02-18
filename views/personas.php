<div class="box-title">
    <h1>CLIENTES</h1>
</div>
<div class="box">
    <!--                                                                    -->
    <!--                           Ingresar Datos                           -->
    <!--  ================================================================= -->
    <div class="box ">
        <form autocomplete="off">
            <div class="d-grid">
                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/documento.svg" alt="">
                        <label for="nombre" class="form-label">Tipo Documento(<span class="text-red">*</span>):</label>
                    </div>

                    <div class="d-flex">
                        <select name="mostrar" id="tipoDocumentoSelect" class="form-select me-2">
                            <!-- Tipo Documento -->
                        </select>
                        <button class="btn bg-primary" id="modalTipoDocumento" type="button">+</button>
                    </div>
                    <p class="error-campo d-none" id="errorDocumento"></p>
                </div>



                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/nro-documento.svg" alt="">
                        <label for="nroDocumento" class="form-label">Nro Documento(<span class="text-red">*</span>):</label>

                    </div>
                    <input type="number" id="nroDocumento" name="nroDocumento" class="form-control" placeholder="Nro Documento">
                    <p class="error-campo d-none" id="errorNroDocumento"></p>

                </div>


                <div class="col-4">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/persona.svg" alt="">
                        <label for="nombreRazonSocial" class="form-label">Nombre / Razón Social(<span class="text-red">*</span>):</label>

                    </div>
                    <input type="text" id="nombreRazonSocial" name="nombreRazonSocial" class="form-control" placeholder="Nombre / Razón Social">
                    <p class="error-campo d-none" id="errorNombreRazonSocial"></p>

                </div>




                <div class="col-7">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/ubicacion.svg" alt="">
                        <label for="direccion" class="form-label">Direccion(<span class="text-red">*</span>):</label>

                    </div>
                    <input type="text" id="direccion" class="form-control" placeholder="Direccion">
                </div>
                <div class="error-campo d-none" id="errorDocumento"></div>

                <div class="col-5">
                    <div class="d-flex align-items-center mb-1">
                        <img src="views/assets/img/telefono.svg" alt="">
                        <label for="telefono" class="form-label">Telefono:</label>

                    </div>
                    <input type="number" id="telefono" class="form-control" placeholder="Telefono">
                </div>
            </div>
            <div class="form-group d-flex justify-content-center ">
                <button id="btnIngresarPersona" class="btn bg-success mt-4">Aceptar</button>
            </div>

        </form>
    </div>
    <!--                                                                    -->
    <!--                  Modal para tipo documento                           -->
    <!--  ================================================================= -->
    <div id="miModalTipoDocumento" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" id="cerrar">&times;</span>
            <form autocomplete="off">
                <div>
                    <label for="tipoDocumento" class="form-label">Tipo Documento (<span class="text-red">*</span>):</label>
                    <input type="text" id="tipoDocumento" name="tipoDocumento" class="form-control" placeholder="Tipo Documento">
                </div>
                <div class="form-group d-flex justify-content-center ">
                    <button id="btnSetTipoDocumento" class="btn bg-success mt-4">Aceptar</button>
                </div>

            </form>
            <table class="table table-striped table-bordered" id="tablaTiposDocumentos">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tipo Persona</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Se cargaran los documentos -->
                </tbody>
            </table>
        </div>
    </div>

    <!--                                                                    -->
    <!--                          Buscar                                    -->
    <!--  ================================================================= -->
    <div class="box mt-3">
        <form autocomplete="off" class="d-grid">
            <p class="col-3 d-flex align-items-center">
                <label class="form-label me-2">Mostrar:</label>
                <select id="mostrarPersonas" class="form-select me-2">
                    <option value="">Seleccionar ...</option>
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <label class="form-label">registros </label>
            </p>
            <div class="col-5"></div>
            <div class="col-4">
                <p class="d-flex align-items-center">
                    <label class="form-label me-2">Buscar:</label>
                    <input type="text" id="buscarPersona" class="form-control">
                </p>
            </div>
        </form>
        <!--                                                                    -->
        <!--                           Mostrar                                  -->
        <!--  ================================================================= -->
        <table class="table table-striped table-bordered" id="tablaPersonas">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Tipo Doc</th>
                    <th>N° Doc</th>
                    <th>Nombres y Apellidos /Razón social</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las categorías se cargarán aquí -->
            </tbody>
        </table>
        <!-- Cantidad de registros mostrados  -->
        <div id="infoRegistros"></div>
        <!-- Paginacion de los registros  -->
        <nav>
            <ul class="pagination"></ul>
        </nav>

    </div>
</div>
<script src="../views/assets/js/persona.js"></script>