<?php
$skills = mysqli_query($koneksi, "SELECT * FROM skills ORDER BY id ASC");
$skillsLeft = [];
$skillsRight = [];
$idx = 0;
while ($r = mysqli_fetch_assoc($skills)) {
  if ($idx % 2 == 0) $skillsLeft[] = $r; else $skillsRight[] = $r;
  $idx++;
}
?>
<section id="skills" class="skills section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Skills</h2>
    <p>Programming Language, Framework Front-End, Framework Back-End</p>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row skills-content skills-animation">
      <div class="col-lg-6">
        <?php foreach ($skillsLeft as $s): ?>
          <div class="progress">
            <span class="skill"><span><?= htmlspecialchars($s['name']) ?></span> <i class="val"><?= (int)$s['percentage'] ?>%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= (int)$s['percentage'] ?>%"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-lg-6">
        <?php foreach ($skillsRight as $s): ?>
          <div class="progress">
            <span class="skill"><span><?= htmlspecialchars($s['name']) ?></span> <i class="val"><?= (int)$s['percentage'] ?>%</i></span>
            <div class="progress-bar-wrap">
              <div class="progress-bar" role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= (int)$s['percentage'] ?>%"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>