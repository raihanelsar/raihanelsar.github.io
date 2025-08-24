<?php
// Fetch contact data
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = mysqli_real_escape_string($koneksi, $_POST['name'] ?? '');
    $email   = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
    $subject = mysqli_real_escape_string($koneksi, $_POST['subject'] ?? '');
    $message = mysqli_real_escape_string($koneksi, $_POST['message'] ?? '');

    if ($name && $email && $message) {
        // Save to database
        $sql = "INSERT INTO messages (name, email, subject, message, created_at) 
                VALUES ('$name', '$email', '$subject', '$message', NOW())";
        $saved = mysqli_query($koneksi, $sql);

        if ($saved) {
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Failed to send message. Please try again.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
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

      <!-- Contact Form -->
      <div class="col-lg-7">
        <?php if (!empty($success)): ?>
          <div class="alert alert-success"><?= $success ?></div>
        <?php elseif (!empty($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="php-email-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" name="email" class="form-control" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" name="subject" class="form-control" placeholder="Subject">
          </div>
          <div class="form-group mt-3">
            <textarea name="message" class="form-control" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="text-center mt-3"><button type="submit">Send Message</button></div>
        </form>
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
</section>