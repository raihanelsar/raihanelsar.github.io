<?php
$servicesQ = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id ASC");

// daftar warna shape background (bisa ditambah sesuai kebutuhan)
$colors = ["#e0f7fa", "#fce4ec", "#f3e5f5", "#ede7f6", "#e8eaf6", "#e8f5e9", "#fff3e0"];
?>
<section id="services" class="services section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Services</h2>
    <p>What I can do for you</p>
  </div>
  <div class="container">
    <div class="row gy-4">
      <?php 
      $delay = 100; 
      $i = 0;
      while ($s = mysqli_fetch_assoc($servicesQ)): 
        $color = $colors[$i % count($colors)]; // ambil warna bergilir
      ?>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
          <div class="service-item item-cyan position-relative">
            <div class="icon">
              <!-- Background shape -->
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="<?= $color ?>"
                  d="M300,521.0C373,520.3,454.1,510.5,497.4,448.9C540.6,387.3,532.2,291.9,484.5,228.5C436.8,165,350.1,133.7,276.2,152.4C202.3,171.1,141.2,239.8,120.8,314.3C100.5,388.8,120.8,468.2,174.8,501.8C228.9,535.4,227,521.7,300,521Z">
                </path>
              </svg>
              <!-- Icon -->
              <i class="<?= htmlspecialchars($s['icon']) ?>"></i>
            </div>
            <a href="#" class="stretched-link">
              <h3><?= htmlspecialchars($s['title']) ?></h3>
            </a>
            <p><?= nl2br(htmlspecialchars($s['description'] ?? '')) ?></p>
          </div>
        </div>
      <?php 
        $delay += 100; 
        $i++;
      endwhile; ?>
    </div>
  </div>
</section>
