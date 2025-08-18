<?php
include 'koneksi.php';

$msg = "";

// Proses tambah service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $icon        = mysqli_real_escape_string($koneksi, $_POST['icon'] ?? 'bi bi-activity');
    $title       = mysqli_real_escape_string($koneksi, $_POST['title'] ?? '');
    $description = mysqli_real_escape_string($koneksi, $_POST['description'] ?? '');

    $sql = "INSERT INTO services (icon, title, description) VALUES ('$icon', '$title', '$description')";
    if (mysqli_query($koneksi, $sql)) {
        $msg = "✅ Service berhasil ditambahkan!";
    } else {
        $msg = "❌ Gagal menambahkan: " . mysqli_error($koneksi);
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Service</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="mb-4">➕ Tambah Service</h1>

  <?php if ($msg): ?>
    <div class="alert alert-info alert-dismissible fade show">
      <?= $msg ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <form method="post" class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Icon Class</label>
      <input type="text" name="icon" class="form-control" placeholder="bi bi-broadcast" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Judul</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="col-md-12">
      <label class="form-label">Deskripsi</label>
      <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">💾 Simpan</button>
      <a href="?page=services" class="btn btn-secondary">⬅ Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
