<?php
include 'koneksi.php';
$msg = '';

// Proses simpan atau update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($koneksi, $_POST['address'] ?? '');
    $phone   = mysqli_real_escape_string($koneksi, $_POST['phone'] ?? '');
    $email   = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
    $map     = mysqli_real_escape_string($koneksi, $_POST['map_embed'] ?? '');

    // Cek apakah sudah ada data contact
    $exists = mysqli_query($koneksi, "SELECT id FROM contact LIMIT 1");
    if ($row = mysqli_fetch_assoc($exists)) {
        $id = (int)$row['id'];
        mysqli_query($koneksi, "UPDATE contact 
            SET address='$address', phone='$phone', email='$email', map_embed='$map' 
            WHERE id=$id
        ");
    } else {
        mysqli_query($koneksi, "INSERT INTO contact (address, phone, email, map_embed) 
            VALUES ('$address', '$phone', '$email', '$map')
        ");
    }

    $msg = "Contact info saved successfully!";
}

// Ambil data terbaru (kalau ada)
$contact = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add / Edit Contact</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
  <h2>Add / Update Contact</h2>

  <?php if ($msg): ?>
    <div class="alert alert-success"><?= $msg ?></div>
  <?php endif; ?>

  <form method="post" class="row g-3">
    <div class="col-12">
      <label class="form-label">Address</label>
      <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($contact['address'] ?? '') ?></textarea>
    </div>

    <div class="col-md-6">
      <label class="form-label">Phone</label>
      <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($contact['phone'] ?? '') ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>">
    </div>

    <div class="col-12">
      <label class="form-label">Google Maps Embed (iframe code)</label>
      <textarea class="form-control" name="map_embed" rows="4" placeholder='<iframe src="..."></iframe>'><?= htmlspecialchars($contact['map_embed'] ?? '') ?></textarea>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="contact.php" class="btn btn-secondary">Back</a>
    </div>
  </form>

  <?php if (!empty($contact['map_embed'])): ?>
    <div class="mt-4">
      <h5>Map Preview:</h5>
      <div style="border:1px solid #ddd; border-radius:8px; overflow:hidden;">
        <?= $contact['map_embed'] ?>
      </div>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
