<?php
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));
?>

<section id="contact" class="contact section">
  <div class="container">
    <div class="section-title text-center">
      <h2>Contact</h2>
      <p>Silakan hubungi kami melalui informasi di bawah ini atau kirim pesan langsung.</p>
    </div>

    <div class="row gy-4">

      <div class="col-lg-5 d-flex flex-column justify-content-center">
        <div class="info-item d-flex">
          <i class="bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h4>Address:</h4>
            <p><?= htmlspecialchars($data['address'] ?? '') ?></p>
          </div>
        </div>

        <div class="info-item d-flex">
          <i class="bi bi-telephone flex-shrink-0"></i>
          <div>
            <h4>Call Us:</h4>
            <p><?= htmlspecialchars($data['phone'] ?? '') ?></p>
          </div>
        </div>

        <div class="info-item d-flex">
          <i class="bi bi-envelope flex-shrink-0"></i>
          <div>
            <h4>Email Us:</h4>
            <p><?= htmlspecialchars($data['email'] ?? '') ?></p>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <form method="post" class="php-email-form">
          <div class="row gy-4">
            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="col-md-6">
              <input type="email" name="email" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="col-md-12">
              <input type="text" name="subject" class="form-control" placeholder="Subject" required>
            </div>
            <div class="col-md-12">
              <textarea name="message" class="form-control" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </div>

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
</section>