<?php
$queryAbout = mysqli_query($koneksi, "SELECT * FROM about LIMIT 1");
$rowAbout = mysqli_fetch_assoc($queryAbout);
?>
<section id="about" class="about section">
  <div class="container section-title" data-aos="fade-up">
    <h2>About</h2>
    <p><?= $rowAbout['description'] ?></p>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 justify-content-center">
      <div class="col-lg-4">
        <img src="admin/uploads/<?php echo $rowAbout['image'] ?>" class="img-fluid" alt="">
      </div>
      <div class="col-lg-8 content">
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
        <!-- Tombol PDF -->
        <?php if (!empty($rowAbout['pdf'])): ?>
          <div class="mt-4">
            <a href="admin/uploads/<?= htmlspecialchars($rowAbout['pdf']) ?>" class="btn btn-primary btn-lg shadow-sm"
              target="_blank">
              Download PDF
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>