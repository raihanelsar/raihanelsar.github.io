<?php
include '../koneksi.php';
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
        <?= $data['map_embed'] ?>
      </div>
    <?php endif; ?>
    <a href="tambah-contact.php" class="btn btn-warning mt-3">Edit Contact</a>
  <?php else: ?>
    <p>No contact info yet. <a href="?page=tambah-contact" class="btn btn-primary">Add Contact</a></p>
  <?php endif; ?>
</div>
</body>
</html>
