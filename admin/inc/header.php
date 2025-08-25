<header id="header" class="header fixed-top d-flex align-items-center bg-white shadow-sm">

  <div class="d-flex align-items-center justify-content-between w-100 px-3">

    <!-- Logo -->
    <a href="index.php" class="logo d-flex align-items-center text-decoration-none">
      <img src="../assets/img/favicon.ico" alt="Logo" class="me-2" style="height:32px;">
      <span class="d-none d-lg-block fw-bold text-dark">RE Admin</span>
    </a>

    <!-- Sidebar Toggle -->
    <i class="bi bi-list toggle-sidebar-btn ms-3 fs-4 text-secondary"></i>

    <!-- Search Bar -->
    <div class="search-bar ms-4 flex-grow-1 d-none d-md-block">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" class="form-control" placeholder="Search..." title="Enter search keyword">
        <button type="submit" class="btn btn-light ms-2"><i class="bi bi-search"></i></button>
      </form>
    </div>

    <!-- Nav Right -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center list-unstyled mb-0">

        <!-- Notifications -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell fs-5"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge bg-primary ms-2">View all</span></a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li class="dropdown-footer"><a href="#">Show all notifications</a></li>
          </ul>
        </li>

        <!-- Messages -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text fs-5"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge bg-primary ms-2">View all</span></a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li class="dropdown-footer"><a href="#">Show all messages</a></li>
          </ul>
        </li>

        <!-- Profile -->
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/raihanelsar.png" alt="Profile" class="rounded-circle" width="32" height="32">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo isset($_SESSION['NAME']) ? $_SESSION['NAME'] : 'Guest'; ?>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li class="dropdown-header text-center">
              <h6><?php echo isset($_SESSION['NAME']) ? $_SESSION['NAME'] : 'Guest'; ?></h6>
              <small class="text-muted">Web Designer</small>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="users-profile.html"><i class="bi bi-person me-2"></i>My Profile</a></li>
            <li><a class="dropdown-item" href="users-profile.html"><i class="bi bi-gear me-2"></i>Account Settings</a></li>
            <li><a class="dropdown-item" href="pages-faq.html"><i class="bi bi-question-circle me-2"></i>Need Help?</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="keluar.php"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a></li>
          </ul>
        </li>

      </ul>
    </nav>

  </div>
</header>
