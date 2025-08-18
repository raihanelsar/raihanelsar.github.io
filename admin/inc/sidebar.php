<aside id="sidebar" class="sidebar bg-dark text-white vh-100 shadow-sm">

  <ul class="sidebar-nav list-unstyled" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a href="?page=dashboard" class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded active">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <!-- Components -->
    <li class="nav-item">
      <a class="nav-link collapsed d-flex align-items-center gap-2 px-3 py-2 rounded" 
         data-bs-toggle="collapse" href="#components-nav" aria-expanded="false">
        <i class="bi bi-menu-button-wide"></i><span>Components</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse list-unstyled ms-4">
        <li><a href="?page=about"><i class="bi bi-circle"></i> About</a></li>
        <li><a href="?page=skills"><i class="bi bi-circle"></i> Skills</a></li>
        <li><a href="?page=resume"><i class="bi bi-circle"></i> Resume</a></li>
        <li><a href="?page=statistics"><i class="bi bi-circle"></i> Statistics</a></li>
        <li><a href="?page=portfolio"><i class="bi bi-circle"></i> Portfolio</a></li>
        <li><a href="?page=services"><i class="bi bi-circle"></i> Services</a></li>
        <li><a href="?page=contact"><i class="bi bi-circle"></i> Contact</a></li>
      </ul>
    </li>

    <!-- Pages -->
    <li class="nav-heading text-uppercase small fw-bold text-secondary mt-3">Pages</li>
    <li><a href="?page=user" class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded"><i class="bi bi-person"></i>User</a></li>
    <li><a href="?page=setting" class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded"><i class="bi bi-gear"></i>Setting</a></li>

  </ul>

</aside>

<style>
  .sidebar {
    width: 240px;
    position: fixed;
    top: 60px; /* header height */
    left: 0;
    overflow-y: auto;
    transition: all 0.3s;
  }
  .sidebar .nav-link {
    color: #adb5bd;
    font-weight: 500;
    transition: all 0.3s;
  }
  .sidebar .nav-link:hover,
  .sidebar .nav-link.active {
    background: #0d6efd;
    color: #fff;
  }
  .sidebar .nav-content a {
    padding: 6px 0 6px 20px;
    font-size: 14px;
    color: #adb5bd;
    display: block;
  }
  .sidebar .nav-content a:hover {
    color: #fff;
  }
  .toggle-icon {
    transition: transform 0.3s;
  }
  .nav-link[aria-expanded="true"] .toggle-icon {
    transform: rotate(180deg);
  }
</style>
