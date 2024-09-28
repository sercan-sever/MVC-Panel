<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/admin">
        <img class="me-2" src="../assets/images/logos/karelogofav.png" alt="" width="25" height="25">
        Karecode Yazılım
    </a>

    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap border-start">
            <a class="nav-link px-3 logout" href="/logout">
                <span class="admin-first-name me-2"><?php echo authFirstName(); ?></span> Çıkış Yap
            </a>
        </div>
    </div>
</header>