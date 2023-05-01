<div class="container-fluid bg-dark p-3 text-white">
    <div class="container d-flex justify-content-between flex-row">
        <div>
            <span><i class="fas fa-phone-alt text-success"></i> +359 88 248 9370</span>
            <span><i class="fas fa-envelope text-success"></i> momchilll@gmail.com</a></span>
        </div>
        <div>
            <?php if (isset($_SESSION['role_name'])): ?>
                <span><i class="fas fa-user text-success mr-1"></i> <a href="logout.php"
                        class="text-decoration-none text-white">Излез от профила си</a> </span>
            <?php endif; ?>
            <?php if (!isset($_SESSION['role_name'])): ?>
                <span><i class="fas fa-user text-success mr-1"></i> <a href="login.php"
                        class="text-decoration-none text-white">Влез в профила си</a> </span>
                |
                <span> <i class="fas fa-user-plus text-success mr-1"></i> <a href="register.php"
                        class="text-decoration-none text-white">Регистрирай се</a></span>
            <?php endif; ?>
        </div>
    </div>
</div>