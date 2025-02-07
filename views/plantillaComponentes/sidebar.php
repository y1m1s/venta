<!--=============== SIDEBAR ===============-->
<nav class="sidebar" id="sidebar">
    <div class="sidebar__container">
        <div class="sidebar__user">
            <div class="sidebar__img">
                <img src="views/assets/img/perfil.png" alt="image">
            </div>

            <div class="sidebar__info">
                <h3>Yimi Solorzano </h3>
                <span>rix123@gmail.com</span>
            </div>
        </div>

        <div class="sidebar__content">
            <div>
                <h3 class="sidebar__title">Venta</h3>

                <div class="sidebar__list">
                    <a onclick="cargarContenido('views/dashboard.php','main');" class="sidebar__link active-link">
                        <img src="views/assets/img/home.svg" alt="">
                        <span>Principal</span>
                    </a>

                    <a onclick="cargarContenido('views/ventas.php','main');" class="sidebar__link ">
                        <img src="views/assets/img/hamburger.svg" alt="">
                        <span>Ventas</span>
                    </a>

                    <a onclick="cargarContenido('views/categoriaProductos.php','main');" class="sidebar__link ">
                        <img src="views/assets/img/categoria-productos.svg" alt="">
                        <span>Categoria Productos</span>
                    </a>

                    <a onclick="cargarContenido('views/proveedor.php','main');" class="sidebar__link ">
                        <img src="views/assets/img/proveedor.svg" alt="">
                        <span>Proveedor</span>
                    </a>

                    <a onclick="cargarContenido('views/personas.php','main');" class="sidebar__link ">
                        <img src="views/assets/img/hamburger.svg" alt="">
                        <span>Personas</span>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="sidebar__title">Productos</h3>

                <div class="sidebar__list">
                    <a href="#" class="sidebar__link">
                        <img src="views/assets/img/hamburger.svg" alt="">
                        <span>Ventas</span>
                    </a>

                    <a href="#" class="sidebar__link">
                        <img src="views/assets/img/hamburger.svg" alt="">
                        <span>Ventas</span>
                    </a>

                    <a href="#" class="sidebar__link">
                        <img src="views/assets/img/hamburger.svg" alt="">
                        <span>Notificaciones</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar__actions">


            <button class="sidebar__link">
                <img src="views/assets/img/hamburger.svg" alt="">
                <span>Salir</span>
            </button>
        </div>
    </div>
</nav>