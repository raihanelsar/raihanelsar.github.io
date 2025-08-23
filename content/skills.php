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
  uksort($categories['Programming'], function ($a, $b) {
    $order = ['Front-End' => 1, 'Back-End' => 2, 'Lainnya' => 3];
    return ($order[$a] ?? 99) <=> ($order[$b] ?? 99);
  });
}

// Icon per subcategory
function getSubIcon($subcat)
{
  switch ($subcat) {
    case 'Front-End':
      return '<i class="bi bi-code-slash text-primary"></i>';
    case 'Back-End':
      return '<i class="bi bi-hdd-stack text-success"></i>';
    default:
      return '<i class="bi bi-lightning text-purple"></i>';
  }
}

// Warna progress bar
function getBarColor($cat, $subcat = '')
{
  if ($cat === 'Programming') {
    switch ($subcat) {
      case 'Front-End':
        return 'bg-primary';
      case 'Back-End':
        return 'bg-success';
      default:
        return 'bg-purple';
    }
  } else {
    return 'bg-warning';
  }
}
?>

<style>
  .bg-purple {
    background-color: #6f42c1 !important;
  }
  .skill-card {
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
    padding: 1rem; /* lebih kecil */
  }
  .skill-card:hover {
    transform: translateY(-3px);
  }
  .skill-card h4 {
    font-size: 1.2rem;
  }
  .skill-card h6 {
    font-size: 1rem;
    margin-top: 0.75rem;
    margin-bottom: 0.5rem;
  }
  .progress {
    height: 18px;
    margin-bottom: 0.5rem;
  }
  .progress .skill {
    font-size: 0.85rem;
  }
  .progress .val {
    font-size: 0.8rem;
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
      <p class="text-muted">No skills data has been added yet.</p>
    <?php else: ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <?php foreach ($categories as $cat => $skillGroup): ?>
          <div class="col">
            <div class="card skill-card">
              <div class="card-body p-2">
                <h4 class="card-title mb-3"><?= htmlspecialchars($cat) ?></h4>

                <?php if ($cat === 'Programming'): ?>
                  <?php foreach ($skillGroup as $subcat => $skillList): ?>
                    <h6>
                      <?= getSubIcon($subcat) ?> <?= htmlspecialchars($subcat) ?>
                    </h6>
                    <?php foreach ($skillList as $s): ?>
                      <div class="progress">
                        <span class="skill d-flex justify-content-between w-100">
                          <span><?= htmlspecialchars($s['name']) ?></span>
                          <i class="val"><?= (int)$s['percentage'] ?>%</i>
                        </span>
                        <div class="progress-bar-wrap">
                          <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat, $subcat) ?>"
                            role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"
                            style="width: <?= (int)$s['percentage'] ?>%"></div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                <?php else: ?>
                  <?php foreach ($skillGroup as $s): ?>
                    <div class="progress">
                      <span class="skill d-flex justify-content-between w-100">
                        <span><?= htmlspecialchars($s['name']) ?></span>
                        <i class="val"><?= (int)$s['percentage'] ?>%</i>
                      </span>
                      <div class="progress-bar-wrap">
                        <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat) ?>"
                          role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"
                          style="width: <?= (int)$s['percentage'] ?>%"></div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<!-- End Skills Section -->
