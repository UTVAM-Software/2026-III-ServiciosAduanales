<?php
function AddHeader() {
    ?>
    <header class="mb-3">
        <nav class="navbar md:navbar-expand bg-1" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="sa.brand.png" width="30" height="30" />
                    Servicios Aduanales
                </a>
                <button class="btn-icon navbar-toggler" type="button" data-bs-toggle="drawer"
                    data-bs-target="#navbarDrawer" aria-controls="navbarDrawer" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" aria-hidden="true"></span>
                </button>
                <dialog class="drawer drawer-end" tabindex="-1" id="navbarDrawer" aria-labelledby="navbarDrawerLabel">
                    <div class="drawer-header">
                        <h5 class="drawer-title" id="navbarDrawerLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="drawer" aria-label="Close"></button>
                    </div>
                    <div class="drawer-body mb-2 md:mb-0">
                        <ul class="nav navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" type="button" data-bs-toggle="menu" aria-expanded="false">
                                    Servicios
                                </button>
                                <div class="menu">
                                    <a class="menu-item" href="#">Servicios</a>
                                    <a class="menu-item" href="#">Pedidos</a>
                                    <hr class="menu-divider">
                                    <a class="menu-item" href="#">Incidencias</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sa.clientes.php">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Proveedores</a>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" type="button" data-bs-toggle="menu" aria-expanded="false">
                                    Reportes
                                </button>
                                <div class="menu">
                                    <a class="menu-item" href="#">Servicios</a>
                                    <a class="menu-item" href="#">Clientes</a>
                                    <hr class="menu-divider">
                                    <a class="menu-item" href="#">Incidencias</a>
                                </div>
                            </li>
                        </ul>
                        <form class="hstack gap-2" role="search">
                            <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" />
                            <button class="btn-solid btn-icon theme-secondary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </dialog>
            </div>
        </nav>
    </header>
    <?php
}
