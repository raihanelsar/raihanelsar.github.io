<?php
<<<<<<< HEAD
include '../koneksi.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($koneksi, $_POST['address']);
    $phone   = mysqli_real_escape_string($koneksi, $_POST['phone']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);
    $map     = mysqli_real_escape_string($koneksi, $_POST['map_embed']);

    $check = mysqli_query($koneksi, "SELECT id FROM contact LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
=======
include 'koneksi.php';

// Pesan feedback
$msg = '';

// Simpan atau update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($koneksi, $_POST['address'] ?? '');
    $phone   = mysqli_real_escape_string($koneksi, $_POST['phone'] ?? '');
    $email   = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
    $map     = mysqli_real_escape_string($koneksi, $_POST['map_embed'] ?? '');

    // Cek apakah sudah ada data
    $exists = mysqli_query($koneksi, "SELECT id FROM contact ORDER BY id DESC LIMIT 1");
    if ($row = mysqli_fetch_assoc($exists)) {
>>>>>>> a7ac288b6045e9237d239f79c1820da2442f93ec
        $id = (int)$row['id'];
        mysqli_query($koneksi, "UPDATE contact SET address='$address', phone='$phone', email='$email', map_embed='$map' WHERE id=$id");
    } else {
        mysqli_query($koneksi, "INSERT INTO contact (address, phone, email, map_embed) VALUES ('$address', '$phone', '$email', '$map')");
    }
<<<<<<< HEAD
    $msg = "Saved!";
}

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));
=======

    $msg = "Saved!";
}

// Ambil data terbaru
$curr = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact ORDER BY id DESC LIMIT 1"));
>>>>>>> a7ac288b6045e9237d239f79c1820da2442f93ec
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
<<<<<<< HEAD
  <title>Edit Contact</title>
=======
  <title>Add Contact</title>
>>>>>>> a7ac288b6045e9237d239f79c1820da2442f93ec
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
<<<<<<< HEAD
  <h2>Edit Contact Info</h2>
  <?php if ($msg): ?><div class="alert alert-success"><?= $msg ?></div><?php endif; ?>

  <form method="post" class="row g-3">
    <div class="col-12">
      <label class="form-label">Address</label>
      <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
    </div>
    <div class="col-md-6">
      <label class="form-label">Phone</label>
      <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($data['phone'] ?? '') ?>">
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
    </div>
    <div class="col-12">
      <label class="form-label">Google Maps Embed</label>
      <textarea class="form-control" name="map_embed" rows="4" placeholder='<iframe src="..."></iframe>'><?= htmlspecialchars($data['map_embed'] ?? '') ?></textarea>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="?page=contact" class="btn btn-secondary">Back</a>
=======
  <h1>Add / Update Contact</h1>

  <?php if ($msg): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php endif; ?>

  <form method="post" class="row g-3">
    <div class="col-md-12">
      <label class="form-label">Address</label>
      <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($curr['address'] ?? '') ?></textarea>
    </div>
    <div class="col-md-6">
      <label class="form-label">Phone</label>
      <input class="form-control" name="phone" value="<?= htmlspecialchars($curr['phone'] ?? '') ?>">
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($curr['email'] ?? '') ?>">
    </div>
    <div class="col-md-12">
      <label class="form-label">Google Maps Embed (iframe code)</label>
      <textarea class="form-control" name="map_embed" rows="4"><?= htmlspecialchars($curr['map_embed'] ?? '') ?></textarea>
    </div>
    <div class="col-12">
      <button class="btn btn-primary">Save</button>
      <a class="btn btn-secondary" href="?page=contact">Back</a>
>>>>>>> a7ac288b6045e9237d239f79c1820da2442f93ec
    </div>
  </form>
</div>
</body>
</html>
