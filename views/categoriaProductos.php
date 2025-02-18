<div class="box-title">
    <h1>CATEGORIA PRODUCTOS</h1>
</div>
<div class="d-grid box">
    <!--                                                                    -->
    <!--                           Ingresar Datos                           -->
    <!--  ================================================================= -->
    <div class="box col-4 height-250">
        <form autocomplete="off">
            <div>
                <div class="d-flex align-items-center mb-1">
                    <img src="views/assets/img/documento.svg" alt="">
                    <label for="nombre" class="form-label">Categoria(<span class="text-red">*</span>):</label>
                </div>

                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa tu categoria">
                <div class="error-campo" id="errorCategoria"></div>
                <div class="d-flex align-items-center mb-1 mt-3">
                    <img src="views/assets/img/descripcion.svg" alt="">
                    <label for="descripcion" class="form-label">Descripcion:</label>
                </div>
                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingresa una descripcion de la categoria">
            </div>
            <div class="form-group d-flex justify-content-center ">
                <button id="btnIngresar" class="btn bg-success mt-4" type="button">Aceptar</button>
            </div>

        </form>
    </div>
    <div class="col-1"></div>
    <!--                                                                    -->
    <!--                          Buscar                                    -->
    <!--  ================================================================= -->
    <div class="box col-7">
        <form autocomplete="off" class="d-grid">
            <p class="col-4 d-flex align-items-center">
                <label class="form-label me-2">Mostrar:</label>
                <select name="mostrar" id="mostrar" class="form-select me-2">
                    <option value="">Seleccionar ...</option>
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <label class="form-label">registros </label>
            </p>
            <div class="col-3">

                <button id="btnGenerarPDF" class="btn bg-danger ms-5">
                    <img src="views/assets/img/imprimir.svg" alt="">
                </button>
            </div>
            <div class="col-5">
                <p class="d-flex align-items-center">
                    <label class="form-label me-2">Buscar:</label>
                    <input type="text" name="campo" id="campo" class="form-control">
                </p>

            </div>


        </form>
        <!--                                                                    -->
        <!--                         Mostrar                                    -->
        <!--  ================================================================= -->
        <table class="table table-striped table-bordered" id="tablaCategorias">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
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
<script src="../views/assets/js/modalConfirm.js"></script>
<script src="../views/assets/js/categoria.js"></script>