<?php
$educationQ     = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='education' ORDER BY id ASC");
$certificationQ = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='certification' ORDER BY id ASC");
$organizationQ  = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='organization' ORDER BY id ASC");
$experienceQ    = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='experience' ORDER BY id ASC");
?>
<section id="resume" class="resume section">
  <div class="container section-title" data-aos="fade-up">
    <h2><i class="bi bi-card-list me-2"></i>Resume</h2>
  </div>
  <div class="container">
    <div class="row">
      
      <!-- Education -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <h3 class="resume-title"><i class="bi bi-mortarboard-fill me-2"></i>Education</h3>
        <?php while ($r = mysqli_fetch_assoc($educationQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><i class="bi bi-calendar me-1"></i><?= htmlspecialchars(trim(($r['year_start'] ?? '') . ' - ' . ($r['year_end'] ?? ''))) ?></h5>
            <p><em><i class="bi bi-geo-alt-fill me-1"></i><?= htmlspecialchars($r['subtitle'] ?? '') ?></em></p>
            <p><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></p>
            <?php if (!empty($r['link'])): ?>
              <a href="<?= htmlspecialchars($r['link']) ?>" target="_blank" rel="noopener">
                <i class="bi bi-link-45deg me-1"></i>Certificate / Info
              </a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>

        <!-- Certification -->
        <h3 class="resume-title mt-4"><i class="bi bi-award-fill me-2"></i>Certifications</h3>
        <?php while ($r = mysqli_fetch_assoc($certificationQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><i class="bi bi-calendar-check me-1"></i><?= htmlspecialchars($r['year_end'] ?? '') ?></h5>
            <p><em><i class="bi bi-building me-1"></i><?= htmlspecialchars($r['subtitle'] ?? '') ?></em></p>
            <p><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></p>
            <?php if (!empty($r['link'])): ?>
              <a href="<?= htmlspecialchars($r['link']) ?>" target="_blank" rel="noopener">
                <i class="bi bi-link-45deg me-1"></i>View Certificate
              </a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Organizations & Experience -->
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <h3 class="resume-title"><i class="bi bi-people-fill me-2"></i>Organizations</h3>
        <?php while ($r = mysqli_fetch_assoc($organizationQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><i class="bi bi-calendar me-1"></i><?= htmlspecialchars(trim(($r['year_start'] ?? '') . ' - ' . ($r['year_end'] ?? ''))) ?></h5>
            <p><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></p>
            <?php if (!empty($r['link'])): ?>
              <a href="<?= htmlspecialchars($r['link']) ?>" target="_blank" rel="noopener">
                <i class="bi bi-link-45deg me-1"></i>More Info
              </a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>

        <!-- Experience -->
        <h3 class="resume-title mt-4"><i class="bi bi-briefcase-fill me-2"></i>Professional Experience</h3>
        <?php while ($r = mysqli_fetch_assoc($experienceQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><i class="bi bi-calendar me-1"></i><?= htmlspecialchars(trim(($r['year_start'] ?? '') . ' - ' . ($r['year_end'] ?? ''))) ?></h5>
            <p><em><i class="bi bi-building me-1"></i><?= htmlspecialchars($r['subtitle'] ?? '') ?></em></p>
            <p><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></p>
            <?php if (!empty($r['link'])): ?>
              <a href="<?= htmlspecialchars($r['link']) ?>" target="_blank" rel="noopener">
                <i class="bi bi-link-45deg me-1"></i>Portfolio / Reference
              </a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</section>
