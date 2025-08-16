<?php
include 'koneksi.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $icon = mysqli_real_escape_string($koneksi, $_POST['icon'] ?? 'bi bi-activity');
  $title = mysqli_real_escape_string($koneksi, $_POST['title'] ?? '');
  $description = mysqli_real_escape_string($koneksi, $_POST['description'] ?? '');
  mysqli_query($koneksi, "INSERT INTO services (icon,title,description) VALUES ('$icon','$title','$description')");
  $msg = 'Service added!';
}

$rows = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id ASC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Service</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
  <h1>Add Service</h1>
  <?php if ($msg): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php endif; ?>

  <form method="post" class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Icon class</label>
      <input class="form-control" name="icon" placeholder="bi bi-broadcast">
    </div>
    <div class="col-md-4">
      <label class="form-label">Title</label>
      <input class="form-control" name="title" required>
    </div>
    <div class="col-md-12">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <div class="col-12">
      <button class="btn btn-primary">Add</button>
      <a class="btn btn-secondary" href="?page=services">Back</a>
    </div>
  </form>

  <hr>
  <h3>Existing Services</h3>
  <table class="table table-bordered">
    <thead><tr><th>#</th><th>Icon</th><th>Title</th><th>Description</th></tr></thead>
    <tbody>
      <?php $i=1; while($r=mysqli_fetch_assoc($rows)): ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><i class="<?= htmlspecialchars($r['icon']) ?>"></i> <code><?= htmlspecialchars($r['icon']) ?></code></td>
        <td><?= htmlspecialchars($r['title']) ?></td>
        <td><?= nl2br(htmlspecialchars($r['description'])) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
