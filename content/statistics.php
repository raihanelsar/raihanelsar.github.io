<?php
// Pastikan koneksi sudah ada
$stats = mysqli_query($koneksi, "SELECT * FROM statistics ORDER BY id ASC");
?>
<section id="stats" class="stats section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

      <?php if ($stats && mysqli_num_rows($stats) > 0): ?>
        <?php while ($s = mysqli_fetch_assoc($stats)): ?>
          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="<?= htmlspecialchars($s['icon']) ?>"></i>
            <div class="stats-item">
              <span 
                data-purecounter-start="0" 
                data-purecounter-end="<?= intval($s['value']) ?>" 
                data-purecounter-duration="1" 
                class="purecounter">
              </span>
              <p><?= htmlspecialchars($s['label']) ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p class="text-muted">No statistics available.</p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
