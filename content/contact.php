<?php
$contactQ = mysqli_query($koneksi, "SELECT * FROM contact ORDER BY id DESC LIMIT 1");
$contact = mysqli_fetch_assoc($contactQ);
?>
<section id="contact" class="contact section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>Get in touch</p>
  </div>
  <div class="container" data-aos="fade" data-aos-delay="100">
    <div class="row gy-4">
      <div class="col-lg-4">
        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
          <i class="bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h3>Address</h3>
            <p><?= htmlspecialchars($contact['address'] ?? '') ?></p>
          </div>
        </div>
        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
          <i class="bi bi-telephone flex-shrink-0"></i>
          <div>
            <h3>Call</h3>
            <p><?= htmlspecialchars($contact['phone'] ?? '') ?></p>
          </div>
        </div>
        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
          <i class="bi bi-envelope flex-shrink-0"></i>
          <div>
            <h3>Email</h3>
            <p><?= htmlspecialchars($contact['email'] ?? '') ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
          <div class="row gy-4">
            <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Your Name" required></div>
            <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Your Email" required></div>
            <div class="col-md-12"><input type="text" name="subject" class="form-control" placeholder="Subject" required></div>
            <div class="col-md-12"><textarea name="message" rows="6" class="form-control" placeholder="Message" required></textarea></div>
            <div class="col-md-12 text-center">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
              <button type="submit">Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>