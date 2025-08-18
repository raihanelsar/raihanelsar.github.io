<?php
include 'koneksi.php';

// Hapus service
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($koneksi, "DELETE FROM services WHERE id=$id");
    header("Location: ?page=services&msg=deleted");
    exit;
}

// Ambil semua service
$services = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Manajemen Services</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="mb-4">🛠 Manajemen Services</h1>

  <!-- Notifikasi -->
  <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
    <div class="alert alert-success alert-dismissible fade show">
      ✅ Service berhasil dihapus!
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Tombol Tambah -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="?page=tambah-services" class="btn btn-primary">+ Tambah Service</a>
  </div>

  <!-- Tabel Data -->
  <div class="table-responsive shadow-sm rounded">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th style="width:60px">#</th>
          <th style="width:120px">Icon</th>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th style="width:120px">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $i=1; 
      if (mysqli_num_rows($services) > 0):
          while ($row = mysqli_fetch_assoc($services)): ?>
          <tr>
            <td class="text-center"><?= $i++ ?></td>
            <td>
              <i class="<?= htmlspecialchars($row['icon']) ?> fs-4"></i><br>
              <code><?= htmlspecialchars($row['icon']) ?></code>
            </td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
            <td class="text-center">
              <a href="?page=services&del=<?= $row['id'] ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Yakin ingin menghapus service ini?')">🗑 Hapus</a>
            </td>
          </tr>
      <?php endwhile; else: ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Belum ada data service</td>
          </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
