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

// Tentukan icon untuk subcategory Programming
function getSubIcon($subcat)
{
  switch ($subcat) {
    case 'Front-End':
      return '<i class="fas fa-code text-primary"></i>';
    case 'Back-End':
      return '<i class="fas fa-server text-success"></i>';
    default:
      return '<i class="fas fa-bolt text-purple"></i>';
  }
}

// Tentukan ikon untuk kategori non-programming
function getCatIcon($cat)
{
  switch ($cat) {
    case 'Tools':
      return '<i class="fas fa-tools text-warning"></i>';
    case 'Soft Skills':
      return '<i class="fas fa-brain text-info"></i>';
    case 'Design':
      return '<i class="fas fa-paint-brush text-danger"></i>';
    case 'Database':
      return '<i class="fas fa-database text-success"></i>';
    case 'Others':
      return '<i class="fas fa-star text-secondary"></i>';
    default:
      return '<i class="fas fa-cogs text-dark"></i>';
  }
}

// Tentukan warna progress bar
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

// Mapping skill name ke icon
function getSkillIcon($name)
{
  $map = [
    'HTML' => '<i class="fab fa-html5 text-danger"></i>',
    'CSS' => '<i class="fab fa-css3-alt text-primary"></i>',
    'JavaScript' => '<i class="fab fa-js text-warning"></i>',
    'PHP' => '<i class="fab fa-php text-secondary"></i>',
    'Python' => '<i class="fab fa-python text-info"></i>',
    'Laravel' => '<i class="fab fa-laravel text-danger"></i>',
    'React' => '<i class="fab fa-react text-info"></i>',
    'Bootstrap' => '<i class="fab fa-bootstrap text-purple"></i>',
    'MySQL' => '<i class="fas fa-database text-success"></i>',
    'Git' => '<i class="fab fa-git-alt text-danger"></i>'
  ];
  return $map[$name] ?? '<i class="fas fa-code"></i>';
}
?>

<style>
  .bg-purple {
    background-color: #6f42c1 !important;
  }

  h4.category-title i,
  h5.subcategory-title i {
    margin-right: 8px;
  }
</style>

<section id="skills" class="skills section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Skills</h2>
    <p>Some of the skills that I have mastered in the programming and non-programming fields.</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <?php if (empty($categories)): ?>
      <p class="text-muted">No skills data has been added yet.</p>
    <?php else: ?>
      <?php foreach ($categories as $cat => $skillGroup): ?>
        <h4 class="mt-4 category-title"><?= getCatIcon($cat) ?> <?= htmlspecialchars($cat) ?></h4>

        <?php if ($cat === 'Programming'): ?>
          <?php foreach ($skillGroup as $subcat => $skillList): ?>
            <h5 class="mt-3 ms-3 subcategory-title"><?= getSubIcon($subcat) ?> <?= htmlspecialchars($subcat) ?></h5>
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
                      <span><?= getSkillIcon($s['name']) ?> <?= htmlspecialchars($s['name']) ?></span>
                      <i class="val"><?= (int)$s['percentage'] ?>%</i>
                    </span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat, $subcat) ?>"
                        role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"
                        style="width: <?= (int)$s['percentage'] ?>%"></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="col-lg-6">
                <?php foreach ($right as $s): ?>
                  <div class="progress">
                    <span class="skill">
                      <span><?= getSkillIcon($s['name']) ?> <?= htmlspecialchars($s['name']) ?></span>
                      <i class="val"><?= (int)$s['percentage'] ?>%</i>
                    </span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat, $subcat) ?>"
                        role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"
                        style="width: <?= (int)$s['percentage'] ?>%"></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
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
                    <span><?= getSkillIcon($s['name']) ?> <?= htmlspecialchars($s['name']) ?></span>
                    <i class="val"><?= (int)$s['percentage'] ?>%</i>
                  </span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat) ?>"
                      role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"
                      style="width: <?= (int)$s['percentage'] ?>%"></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="col-lg-6">
              <?php foreach ($right as $s): ?>
                <div class="progress">
                  <span class="skill">
                    <span><?= getSkillIcon($s['name']) ?> <?= htmlspecialchars($s['name']) ?></span>
                    <i class="val"><?= (int)$s['percentage'] ?>%</i>
                  </span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= getBarColor($cat) ?>"
                      role="progressbar" aria-valuenow="<?= (int)$s['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"
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

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">