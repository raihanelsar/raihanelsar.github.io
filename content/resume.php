<?php
$summaryQ = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='summary' ORDER BY id ASC");
$educationQ = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='education' ORDER BY id ASC");
$organizationQ = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='organization' ORDER BY id ASC");
$experienceQ = mysqli_query($koneksi, "SELECT * FROM resume WHERE section_type='experience' ORDER BY id ASC");
?>
<section id="resume" class="resume section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Resume</h2>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

        <h3 class="resume-title">Education</h3>
        <?php while ($r = mysqli_fetch_assoc($educationQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><?= htmlspecialchars(trim(($r['year_start'] ?? '') . ' - ' . ($r['year_end'] ?? ''))) ?></h5>
            <p><em><?= htmlspecialchars($r['subtitle'] ?? '') ?></em></p>
            <p><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></p>
            <?php if (!empty($r['link_url']) && !empty($r['link_title'])): ?>
              <a href="<?= htmlspecialchars($r['link_url']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($r['link_title']) ?></a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <h3 class="resume-title">Organizations</h3>
        <?php while ($r = mysqli_fetch_assoc($organizationQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><?= htmlspecialchars(trim(($r['year_start'] ?? '') . ' - ' . ($r['year_end'] ?? ''))) ?></h5>
            <p><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></p>
            <?php if (!empty($r['link_url']) && !empty($r['link_title'])): ?>
              <a href="<?= htmlspecialchars($r['link_url']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($r['link_title']) ?></a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>

        <h3 class="resume-title">Professional Experience</h3>
        <?php while ($r = mysqli_fetch_assoc($experienceQ)): ?>
          <div class="resume-item">
            <h4><?= htmlspecialchars($r['title']) ?></h4>
            <h5><?= htmlspecialchars(trim(($r['year_start'] ?? '') . ' - ' . ($r['year_end'] ?? ''))) ?></h5>
            <p><em><?= htmlspecialchars($r['location'] ?? '') ?></em></p>
            <ul>
              <li><?= nl2br(htmlspecialchars($r['description'] ?? '')) ?></li>
            </ul>
            <?php if (!empty($r['link_url']) && !empty($r['link_title'])): ?>
              <a href="<?= htmlspecialchars($r['link_url']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($r['link_title']) ?></a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</section>