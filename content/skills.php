<?php
// Ambil data skills
$skills = mysqli_query($koneksi, "SELECT * FROM skills ORDER BY category ASC, subcategory ASC, id ASC");

// Group skills by category & subcategory
$categories = [];
while ($r = mysqli_fetch_assoc($skills)) {
    if ($r['category'] === 'Programming') {
        $sub = $r['subcategory'] ?: 'Lainnya';
        $categories['Programming'][$sub][] = $r;
    } else {
        $categories[$r['category']][] = $r;
    }
}

// Urutkan subcategory Programming
if (isset($categories['Programming'])) {
    uksort($categories['Programming'], function($a, $b) {
        $order = ['Front-End' => 1, 'Back-End' => 2, 'Lainnya' => 3];
        return ($order[$a] ?? 99) <=> ($order[$b] ?? 99);
    });
}

// Tentukan icon & warna progress bar
function getSubIcon($subcat) {
    switch ($subcat) {
        case 'Front-End': return '<i class="bi bi-code-slash text-primary"></i>';
        case 'Back-End': return '<i class="bi bi-hdd-stack text-success"></i>';
        default: return '<i class="bi bi-lightning text-purple"></i>';
    }
}

function getBarColor($cat, $subcat = '') {
    if ($cat === 'Programming') {
        switch ($subcat) {
            case 'Front-End': return 'bg-primary';
            case 'Back-End': return 'bg-success';
            default: return 'bg-purple';
        }
    } else {
        return 'bg-warning';
    }
}
?>

<!-- Tambahkan CSS custom -->
<style>
.bg-purple {
  background-color: #6f42c1 !important;
}
</style>

<!-- ======= Skills Section ======= -->
<section id="skills" class="skills section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Skills</h2>
    <p>Some of the skills that I have mastered in the programming and non-programming fields.</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <?php if (empty($categories)): ?>
      <p class="text-muted">Belum ada data skills yang ditambahkan.</p>
    <?php else: ?>
      <?php foreach ($categories as $cat => $skillGroup): ?>
        <h4 class="mt-4"><?= htmlspecialchars($cat) ?></h4>

        <?php if ($cat === 'Programming'): ?>
          <?php foreach ($skillGroup as $subcat => $skillList): ?>
            <h5 class="mt-3 ms-3">
              <?= getSubIcon($subcat) ?> <?= htmlspecialchars($subcat) ?>
            </h5>
            <div class="row skills-content skills-animation">
              <?php 
              $half = ceil(count($skillList) / 2);
              $left = array_slice($skillList, 0, $half);
              $right = array_slice($skillList, $half);
              ?>
              <div class="col-lg-6">
                <?php foreach ($left as $s): ?>
                  <div class="progress">
                    <span class="skill">
                      <span><?= htmlspecialchars($s['name']) ?></span> 
                      <i class="val"><?= (int)$s['percentage'] ?>%</i>
                    </span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat, $subcat) ?>" 
                           role="progressbar" 
                           aria-valuenow="<?= (int)$s['percentage'] ?>" 
                           aria-valuemin="0" aria-valuemax="100" 
                           style="width: <?= (int)$s['percentage'] ?>%"></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="col-lg-6">
                <?php foreach ($right as $s): ?>
                  <div class="progress">
                    <span class="skill">
                      <span><?= htmlspecialchars($s['name']) ?></span> 
                      <i class="val"><?= (int)$s['percentage'] ?>%</i>
                    </span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat, $subcat) ?>" 
                           role="progressbar" 
                           aria-valuenow="<?= (int)$s['percentage'] ?>" 
                           aria-valuemin="0" aria-valuemax="100" 
                           style="width: <?= (int)$s['percentage'] ?>%"></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>

        <?php else: ?>
          <!-- Untuk kategori selain Programming -->
          <div class="row skills-content skills-animation">
            <?php 
            $half = ceil(count($skillGroup) / 2);
            $left = array_slice($skillGroup, 0, $half);
            $right = array_slice($skillGroup, $half);
            ?>
            <div class="col-lg-6">
              <?php foreach ($left as $s): ?>
                <div class="progress">
                  <span class="skill">
                    <span><?= htmlspecialchars($s['name']) ?></span> 
                    <i class="val"><?= (int)$s['percentage'] ?>%</i>
                  </span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat) ?>" 
                         role="progressbar" 
                         aria-valuenow="<?= (int)$s['percentage'] ?>" 
                         aria-valuemin="0" aria-valuemax="100" 
                         style="width: <?= (int)$s['percentage'] ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="col-lg-6">
              <?php foreach ($right as $s): ?>
                <div class="progress">
                  <span class="skill">
                    <span><?= htmlspecialchars($s['name']) ?></span> 
                    <i class="val"><?= (int)$s['percentage'] ?>%</i>
                  </span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat) ?>" 
                         role="progressbar" 
                         aria-valuenow="<?= (int)$s['percentage'] ?>" 
                         aria-valuemin="0" aria-valuemax="100" 
                         style="width: <?= (int)$s['percentage'] ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
<!-- End Skills Section -->
