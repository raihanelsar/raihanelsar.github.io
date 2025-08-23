<?php
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));
?>

<section id="contact" class="contact section">
  <div class="container">
    
    <!-- Section Title -->
    <div class="section-title text-center">
      <h2>Contact</h2>
      <p>Please contact us using the information below or send us a direct message.</p>
    </div>

    <div class="row gy-4">

      <!-- Contact Info -->
      <div class="col-lg-5 d-flex flex-column justify-content-center">

        <!-- Address -->
        <div class="info-item d-flex">
          <i class="bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h4>Address:</h4>
            <p><?= htmlspecialchars($data['address'] ?? '') ?></p>
          </div>
        </div>

        <!-- Phone -->
        <div class="info-item d-flex">
          <i class="bi bi-telephone flex-shrink-0"></i>
          <div>
            <h4>Call Us:</h4>
            <p><?= htmlspecialchars($data['phone'] ?? '') ?></p>
          </div>
        </div>

        <!-- Email -->
        <div class="info-item d-flex">
          <i class="bi bi-envelope flex-shrink-0"></i>
          <div>
            <h4>Email Us:</h4>
            <p><?= htmlspecialchars($data['email'] ?? '') ?></p>
          </div>
        </div>

      </div>

      <!-- Map -->
      <?php if (!empty($data['map_embed'])): ?>
        <div class="row mt-5">
          <div class="col-12">
            <h4>Our Location</h4>
            <div style="border-radius:8px; overflow:hidden; min-height:300px;">
              <?= $data['map_embed'] ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
