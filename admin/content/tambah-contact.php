<?php
// =============================
// DIR: admin/add_contact.php
// =============================
?>
<?php
include 'koneksi.php';
include '_helpers.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $address = clean($koneksi, $_POST['address'] ?? '');
  $phone = clean($koneksi, $_POST['phone'] ?? '');
  $email = clean($koneksi, $_POST['email'] ?? '');
  // keep single row
  $exists = mysqli_query($koneksi, "SELECT id FROM contact ORDER BY id DESC LIMIT 1");
  if ($row = mysqli_fetch_assoc($exists)) {
    $id = (int)$row['id'];
    mysqli_query($koneksi, "UPDATE contact SET address='$address',phone='$phone',email='$email' WHERE id=$id");
  } else {
    mysqli_query($koneksi, "INSERT INTO contact (address,phone,email) VALUES ('$address','$phone','$email')");
  }
  $msg = 'Saved!';
}
$curr = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact ORDER BY id DESC LIMIT 1"));
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Contact</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"></head>
<body class="p-4"><div class="container">
<h1>Add / Update Contact</h1>
<?php if ($msg): ?><div class="alert alert-success"><?= $msg ?></div><?php endif; ?>
<form method="post" class="row g-3">
  <div class="col-md-12"><label class="form-label">Address</label><textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($curr['address'] ?? '') ?></textarea></div>
  <div class="col-md-6"><label class="form-label">Phone</label><input class="form-control" name="phone" value="<?= htmlspecialchars($curr['phone'] ?? '') ?>"></div>
  <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="<?= htmlspecialchars($curr['email'] ?? '') ?>"></div>
  <div class="col-12"><button class="btn btn-primary">Save</button> <a class="btn btn-secondary" href="index.php">Back</a></div>
</form>
</div></body></html>