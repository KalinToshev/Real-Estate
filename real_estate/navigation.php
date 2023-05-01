<header class="p-3 bg-white border shadow ">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <?php if (isset($_SESSION['role_name'])): ?>
        <a href="home.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img src="images/logo.png" alt="Logo" width="80" height="64">
        </a>
      <?php endif; ?>
      <?php if (!isset($_SESSION['role_name'])): ?>
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img src="images/logo.png" alt="Logo" width="80" height="64">
        </a>
      <?php endif; ?>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a class="nav-link px-2 text-dark" href="about-us.php">За нас</a></li>
        <li class="nav-item"><a class="nav-link px-2 text-dark" href="contact-us.php">Контакти</a></li>
        <?php if (isset($_SESSION['role_name']) && $_SESSION['role_name'] == 'user'): ?>
          <li class="nav-item"><a class="nav-link px-2 text-dark" href="properties.php">Имоти</a></li>
          <li class="nav-item"><a class="nav-link px-2 text-dark" href="profile.php">Акаунт</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['role_name']) && $_SESSION['role_name'] == 'admin'): ?>
          <li class="nav-item"><a class="nav-link px-2 text-dark" href="properties.php">Имоти</a></li>
          <li class="nav-item"><a class="nav-link px-2 text-dark" href="profile.php">Акаунт</a></li>
          <li class="nav-item"><a class="nav-link px-2 text-dark" href="admin.php">Администраторски панел</a></li>
        <?php endif; ?>
      </ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="submit">
        <?php if (isset($_SESSION['role_name']) && $_SESSION['role_name'] == 'admin'): ?>
          <a href="submitproperty.php" class="btn btn-success rounded-pill ps-4 pe-4">Качи имот</a>
        <?php endif; ?>
      </form>
    </div>
  </div>
</header>