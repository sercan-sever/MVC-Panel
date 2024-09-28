<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admin">
                    <i class="fas fa-users"></i>
                    Kullanıcı Listesi
                </a>
            </li>
            <li class="nav-item mt-3 mb-3">
                <a class="nav-link nav-logout" href="/logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Çıkış Yap
                </a>
            </li>
        </ul>
        <div class="feature-icon bg-gradient admin-name">
            <span class="admin-first-name me-2"><?php echo authFirstName(); ?></span>
            <?php echo authName(); ?>
        </div>
    </div>
</nav>