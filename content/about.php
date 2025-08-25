<?php

$stats = mysqli_query($koneksi, "SELECT * FROM statistics ORDER BY id ASC");

$queryAbout = mysqli_query($koneksi, "SELECT * FROM about LIMIT 1");
$rowAbout   = mysqli_fetch_assoc($queryAbout);
?>

<section id="about" class="about section">
  <div class="container section-title" data-aos="fade-up">
    <h2>About</h2>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 justify-content-center">

      <!-- Foto -->
      <div class="col-lg-5">
        <img src="admin/uploads/<?= $rowAbout['image'] ?>" class="img-fluid" alt="About Image">
      </div>

      <!-- Konten -->
      <div class="col-lg-7 content">
        <h2><?= $rowAbout['title'] ?></h2>

        <div class="row">
          <div class="col-lg-6">
            <ul>
              <li><strong>Birthday:</strong> <span><?= $rowAbout['birthday'] ?></span></li>
              <li><strong>Website:</strong> <span><?= $rowAbout['website'] ?></span></li>
              <li><strong>Phone:</strong> <span><?= $rowAbout['phone'] ?></span></li>
              <li><strong>City:</strong> <span><?= $rowAbout['city'] ?></span></li>
            </ul>
          </div>

          <div class="col-lg-6">
            <ul>
              <li><strong>Age:</strong> <span><?= $rowAbout['age'] ?></span></li>
              <li><strong>Degree:</strong> <span><?= $rowAbout['degree'] ?></span></li>
              <li><strong>Email:</strong> <span><?= $rowAbout['email'] ?></span></li>
            </ul>
          </div>
        </div>

        <!-- Deskripsi -->
        <div class="mt-3">
          <strong>Description:</strong>
          <h4><?= $rowAbout['description'] ?></h4>
        </div>

        <!-- Tombol Download CV -->
        <?php if (!empty($rowAbout['cv'])): ?>
          <div class="mt-4">
            <a href="admin/uploads/<?= $rowAbout['cv'] ?>" class="btn btn-primary" download>
              <i class="bi bi-download"></i> Download CV
            </a>
          </div>
        <?php endif; ?>

      </div>

    </div>
  </div>
</section>

<section id="stats" class="stats section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

      <?php if ($stats && mysqli_num_rows($stats) > 0): ?>
        <?php while ($s = mysqli_fetch_assoc($stats)): ?>
          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="<?= htmlspecialchars($s['icon']) ?>"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="<?= intval($s['value']) ?>"
                data-purecounter-duration="1" class="purecounter">
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