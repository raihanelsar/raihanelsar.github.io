<?php
// Koneksi database
include 'admin/koneksi.php';

// Ambil semua data portfolio
$portfolioQ = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");

// Ambil daftar kategori unik
$catQ = mysqli_query($koneksi, "SELECT DISTINCT category FROM portfolio ORDER BY category ASC");
$categories = [];
while ($c = mysqli_fetch_assoc($catQ)) {
  $categories[] = $c['category'];
}

// Fungsi untuk membuat slug kategori
function slugify($text)
{
  $text = strtolower(trim($text));
  $text = preg_replace('/[^a-z0-9]+/', '-', $text);
  return trim($text, '-');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semua Portfolio</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .portfolio-item {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .portfolio-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .portfolio-info {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 10px;
      border-radius: 8px;
      margin-top: 10px;
    }

    .portfolio-info h4 {
      font-size: 1.1rem;
      margin-bottom: 5px;
    }

    .portfolio-info p {
      font-size: 0.9rem;
      color: #666;
    }

    .portfolio-filters li {
      cursor: pointer;
      padding: 6px 15px;
      border-radius: 20px;
      background-color: #e9ecef;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .portfolio-filters .filter-active {
      background-color: #0d6efd;
      color: white;
    }
  </style>
</head>

<body>
  <div class="container py-5">

    <!-- Judul -->
    <div class="text-center mb-4">
      <h1 class="fw-bold">All Portfolio</h1>
      <p class="text-muted">Collection of works and projects that have been worked on</p>
    </div>

    <!-- Filter Kategori -->
    <ul class="portfolio-filters list-inline text-center mb-4">
      <li class="list-inline-item filter-active" data-filter="*">All</li>
      <?php foreach ($categories as $cat): ?>
        <?php $catSlug = slugify($cat); ?>
        <li class="list-inline-item" data-filter=".filter-<?= $catSlug ?>">
          <?= ucfirst(htmlspecialchars($cat)) ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- List Portfolio -->
    <div class="row gy-4 isotope-container">
      <?php while ($p = mysqli_fetch_assoc($portfolioQ)): ?>
        <?php
        $catSlug = slugify($p['category']);
        $catClass = 'filter-' . $catSlug;

        // Fallback image jika kosong
        $imgFile = !empty($p['image']) ? htmlspecialchars($p['image']) : 'no-image.png';

        // Potong deskripsi
        $desc = !empty($p['description'])
          ? mb_substr($p['description'], 0, 100) . (strlen($p['description']) > 100 ? '...' : '')
          : '';
        ?>
        <div class="col-lg-4 col-md-6 portfolio-item <?= $catClass; ?>">
          <img src="admin/uploads/<?= $imgFile ?>" class="img-fluid rounded shadow-sm"
            alt="<?= htmlspecialchars($p['title']) ?>">

          <div class="portfolio-info">
            <h4><?= htmlspecialchars($p['title']) ?></h4>
            <p><?= htmlspecialchars($desc) ?></p>

            <!-- Zoom Gambar -->
            <a href="admin/uploads/<?= $imgFile ?>" title="<?= htmlspecialchars($p['title']) ?>"
              data-gallery="portfolio-gallery-<?= $catSlug ?>" class="glightbox preview-link me-2">
              <i class="bi bi-zoom-in"></i>
            </a>

            <!-- Link Eksternal -->
            <?php if (!empty($p['link'])): ?>
              <a href="<?= htmlspecialchars($p['link']) ?>" title="Kunjungi Proyek" target="_blank" class="me-2"
                rel="noopener">
                <i class="bi bi-link-45deg"></i>
              </a>
            <?php endif; ?>

            <!-- Tags -->
            <?php if (!empty($p['tags'])): ?>
              <div class="mt-2">
                <?php foreach (explode(',', $p['tags']) as $tag): ?>
                  <span class="badge bg-secondary me-1">
                    <?= htmlspecialchars(trim($tag)) ?>
                  </span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-5">
      <a href="index.php" class="btn btn-outline-secondary">
        ⬅ Back to Homepage
      </a>
    </div>

  </div>

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Inisialisasi isotope
      var iso = new Isotope('.isotope-container', {
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
      });

      // Filter kategori
      document.querySelectorAll('.portfolio-filters li').forEach(function(filterBtn) {
        filterBtn.addEventListener('click', function() {
          document.querySelector('.portfolio-filters .filter-active').classList.remove('filter-active');
          this.classList.add('filter-active');

          let filterValue = this.getAttribute('data-filter');
          iso.arrange({
            filter: filterValue
          });
        });
      });

      // Inisialisasi glightbox
      const lightbox = GLightbox({
        selector: '.glightbox'
      });
    });
  </script>
</body>

</html>