<?php
// Ambil semua data portfolio
$portfolioQ = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");

// Ambil daftar kategori unik
$catQ = mysqli_query($koneksi, "SELECT DISTINCT category FROM portfolio ORDER BY category ASC");
$categories = [];
while ($c = mysqli_fetch_assoc($catQ)) {
  $categories[] = $c['category'];
}

// Fungsi slug kategori
function slugify($text)
{
  $text = strtolower(trim($text));
  $text = preg_replace('/[^a-z0-9]+/', '-', $text);
  return trim($text, '-');
}
?>

<section id="portfolio-detail" class="portfolio section bg-light">
  <div class="container section-title" data-aos="fade-up">
    <h2>All Portfolio</h2>
    <p>A collection of works and projects that have been completed.</p>
  </div>

  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

      <!-- Filter Kategori -->
      <ul class="portfolio-filters isotope-filters mb-4 text-center" data-aos="fade-up" data-aos-delay="100">
        <li data-filter="*" class="filter-active">All</li>
        <?php foreach ($categories as $cat): ?>
          <?php $catSlug = slugify($cat); ?>
          <li data-filter=".filter-<?= $catSlug ?>">
            <?= ucfirst(htmlspecialchars($cat)) ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Semua Portfolio -->
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        <?php while ($p = mysqli_fetch_assoc($portfolioQ)): ?>
          <?php
          $catSlug  = slugify($p['category']);
          $catClass = 'filter-' . $catSlug;
          $imgFile  = !empty($p['image']) ? htmlspecialchars($p['image']) : 'no-image.png';
          ?>
          <div class="col-lg-4 col-md-6 isotope-item <?= $catClass; ?>">
            <div class="card h-100 shadow-sm border-0">
              <img src="admin/uploads/<?= $imgFile ?>" 
                   class="card-img-top rounded-top" 
                   alt="<?= htmlspecialchars($p['title']) ?>">

              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
                <p class="card-text small text-muted">
                  <?= htmlspecialchars($p['description']) ?>
                </p>

                <!-- Tags -->
                <?php if (!empty($p['tags'])): ?>
                  <div class="mb-2">
                    <?php foreach (explode(',', $p['tags']) as $tag): ?>
                      <span class="badge bg-secondary me-1">
                        <?= htmlspecialchars(trim($tag)) ?>
                      </span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class="card-footer d-flex justify-content-between bg-white border-0">
                <!-- Zoom -->
                <a href="admin/uploads/<?= $imgFile ?>" 
                   title="<?= htmlspecialchars($p['title']) ?>"
                   data-gallery="portfolio-gallery-<?= $catSlug ?>" 
                   class="glightbox preview-link text-decoration-none">
                  <i class="bi bi-zoom-in fs-5"></i>
                </a>

                <!-- Link eksternal -->
                <?php if (!empty($p['link'])): ?>
                  <a href="<?= htmlspecialchars($p['link']) ?>" 
                     title="More Details" 
                     class="details-link text-decoration-none" 
                     target="_blank" rel="noopener">
                    <i class="bi bi-link-45deg fs-5"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Tombol Kembali -->
      <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
        <a href="?page=home" class="btn btn-outline-secondary">
          ⬅️ Back to Homepage
        </a>
      </div>

    </div>
  </div>
</section>
