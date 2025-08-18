<?php
include 'koneksi.php';

// Ambil data terbaru
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Contact</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">

  <h2>Contact Info</h2>

  <?php if ($data): ?>
    <p><strong>Address:</strong> <?= htmlspecialchars($data['address']) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($data['phone']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></p>

    <?php if (!empty($data['map_embed'])): ?>
      <div class="mt-3">
        <h5>Map:</h5>
        <div style="border:1px solid #ddd; border-radius:8px; overflow:hidden;">
          <?= $data['map_embed'] ?>
        </div>
      </div>
    <?php endif; ?>

    <a href="?page=tambah-contact&edit=<?= $data['id'] ?>" class="btn btn-success mt-3">Edit Contact</a>
    <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" 
       href="?page=tambah-contact&delete=<?= $data['id'] ?>" 
       class="btn btn-danger mt-3">Delete</a>

  <?php else: ?>
    <p>No contact info yet.</p>
    <a href="?page=tambah-contact" class="btn btn-primary">Add Contact</a>
  <?php endif; ?>

</div>
</body>
</html>
