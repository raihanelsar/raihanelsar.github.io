<?php
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
