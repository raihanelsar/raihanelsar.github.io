<header id="header" class="header d-flex flex-column justify-content-center">
  <i class="header-toggle d-xl-none bi bi-list"></i>

  <nav id="navmenu" class="navmenu">
    <ul>
      <?php 
      // Ambil page dari GET, default home
      $page = isset($_GET['page']) ? $_GET['page'] : 'home';

      // Daftar menu
      $menus = [
        "home"      => ["icon" => "bi bi-house", "label" => "Home"],
        "about"     => ["icon" => "bi bi-person", "label" => "About"],
        "resume"    => ["icon" => "bi bi-file-earmark-text", "label" => "Resume"],
        "portfolio" => ["icon" => "bi bi-images", "label" => "Portfolio"],
        "services"  => ["icon" => "bi bi-hdd-stack", "label" => "Services"],
        "contact"   => ["icon" => "bi bi-envelope", "label" => "Contact"],
      ];

      // Loop menu
      foreach ($menus as $key => $menu) {
          $active = ($page == $key) ? "active" : "";
          echo '
          <li>
            <a href="?page='.$key.'" class="'.$active.'">
              <i class="'.$menu['icon'].' navicon"></i>
              <span>'.$menu['label'].'</span>
            </a>
          </li>';
      }
      ?>
    </ul>
  </nav>
</header>
