<?php
// Ambil semua portfolio
$portfolioQ = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");

// Ambil daftar kategori unik
$catQ = mysqli_query($koneksi, "SELECT DISTINCT category FROM portfolio ORDER BY category ASC");
$categories = [];
while ($c = mysqli_fetch_assoc($catQ)) {
    $categories[] = $c['category'];
}

// Fungsi untuk buat slug kategori (supaya aman di class CSS)
function slugify($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}
?>
<section id="portfolio" class="portfolio section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Portfolio</h2>
  </div>

  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

      <!-- Filter Kategori -->
      <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
        <li data-filter="*" class="filter-active">All</li>
        <?php foreach ($categories as $cat): 
          $catSlug = slugify($cat);
        ?>
          <li data-filter=".filter-<?= $catSlug ?>">
            <?= ucfirst(htmlspecialchars($cat)) ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- List Portfolio -->
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        <?php while ($p = mysqli_fetch_assoc($portfolioQ)): 
          $catSlug = slugify($p['category']);
          $catClass = 'filter-' . $catSlug;

          // fallback image
          $imgFile = !empty($p['image']) ? htmlspecialchars($p['image']) : 'no-image.png';

          // potong deskripsi
          $desc = !empty($p['description']) ? mb_substr($p['description'], 0, 100) . (strlen($p['description']) > 100 ? '...' : '') : '';
        ?>
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?= $catClass; ?>">
            <img src="admin/uploads/<?= $imgFile ?>" class="img-fluid" alt="<?= htmlspecialchars($p['title']) ?>">
            <div class="portfolio-info">
              <h4><?= htmlspecialchars($p['title']) ?></h4>
              <p><?= htmlspecialchars($desc) ?></p>

              <!-- Zoom -->
              <a href="admin/uploads/<?= $imgFile ?>" 
                 title="<?= htmlspecialchars($p['title']) ?>" 
                 data-gallery="portfolio-gallery-<?= $catSlug ?>" 
                 class="glightbox preview-link">
                 <i class="bi bi-zoom-in"></i>
              </a>

              <!-- Link eksternal -->
              <?php if (!empty($p['link'])): ?>
                <a href="<?= htmlspecialchars($p['link']) ?>" 
                   title="More Details" 
                   class="details-link" 
                   target="_blank" rel="noopener">
                   <i class="bi bi-link-45deg"></i>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    </div>
  </div>
</section>
