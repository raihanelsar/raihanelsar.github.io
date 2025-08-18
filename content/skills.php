<?php
// Ambil data skills dengan category & subcategory
$skills = mysqli_query($koneksi, "SELECT * FROM skills ORDER BY category ASC, subcategory ASC, id ASC");

// Group skills by category & subcategory
$categories = [];
while ($r = mysqli_fetch_assoc($skills)) {
    if ($r['category'] === 'Programming') {
        // Default subcategory jika kosong
        $sub = $r['subcategory'] ?: 'Lainnya';
        $categories['Programming'][$sub][] = $r;
    } else {
        $categories[$r['category']][] = $r;
    }
}

// Urutkan subcategory Programming (Front-End dulu, lalu Back-End, baru Lainnya)
if (isset($categories['Programming'])) {
    uksort($categories['Programming'], function($a, $b) {
        $order = ['Front-End' => 1, 'Back-End' => 2, 'Lainnya' => 3];
        return ($order[$a] ?? 99) <=> ($order[$b] ?? 99);
    });
}

// Tentukan icon khusus untuk subcategory
function getSubIcon($subcat) {
    switch ($subcat) {
        case 'Front-End': return '<i class="bi bi-code-slash text-primary"></i>'; // Bootstrap icon
        case 'Back-End': return '<i class="bi bi-hdd-stack text-success"></i>'; 
        default: return '<i class="bi bi-lightning text-warning"></i>'; 
    }
}
?>

<section id="skills" class="skills section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Skills</h2>
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
                      <div class="progress-bar" role="progressbar" 
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
                      <div class="progress-bar" role="progressbar" 
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
                    <div class="progress-bar" role="progressbar" 
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
                    <div class="progress-bar" role="progressbar" 
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
