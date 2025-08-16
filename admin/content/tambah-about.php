<?php
// =============================
// DIR: admin/tambah-about.php
// =============================
include 'koneksi.php';
include '_helpers.php';

$msg = '';
$imageToUse = '';

// Ambil data terakhir (hanya satu row)
$curr = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC LIMIT 1"));

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = clean($koneksi, $_POST['title'] ?? '');
    $description = clean($koneksi, $_POST['description'] ?? '');
    $birthday    = clean($koneksi, $_POST['birthday'] ?? '');
    $website     = clean($koneksi, $_POST['website'] ?? '');
    $phone       = clean($koneksi, $_POST['phone'] ?? '');
    $city        = clean($koneksi, $_POST['city'] ?? '');
    $age         = (int)($_POST['age'] ?? 0);
    $degree      = clean($koneksi, $_POST['degree'] ?? '');
    $email       = clean($koneksi, $_POST['email'] ?? '');

    // Upload gambar
    $img = '';
    if (!empty($_FILES['image']['name'])) {
        $ext_allowed = ["image/png", "image/jpg", "image/jpeg"];
        $type = mime_content_type($_FILES['image']['tmp_name']);

        if (in_array($type, $ext_allowed)) {
            $img = save_upload('image', 'uploads');

            // Hapus gambar lama jika ada dan tidak sama
            if (!empty($curr['image']) && file_exists('uploads/' . $curr['image'])) {
                @unlink('uploads/' . $curr['image']);
            }
        } else {
            $msg = 'Format file tidak didukung. Gunakan PNG, JPG, atau JPEG.';
        }
    }

    // Tentukan gambar yang akan dipakai
    $imageToUse = $img ?: ($curr['image'] ?? '');

    // Jika tidak ada pesan error, simpan data
    if (empty($msg)) {
        if (!empty($curr)) {
            // UPDATE
            $id = (int)$curr['id'];
            $sql = "UPDATE about 
                    SET title='$title', description='$description', image='$imageToUse', 
                        birthday='$birthday', website='$website', phone='$phone', 
                        city='$city', age=$age, degree='$degree', email='$email' 
                    WHERE id=$id";
            mysqli_query($koneksi, $sql);
        } else {
            // INSERT
            $sql = "INSERT INTO about (title, description, image, birthday, website, phone, city, age, degree, email) 
                    VALUES ('$title', '$description', '$imageToUse', '$birthday', '$website', '$phone', '$city', $age, '$degree', '$email')";
            mysqli_query($koneksi, $sql);
        }
        $msg = 'Data berhasil disimpan!';
        // Refresh data terbaru
        $curr = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC LIMIT 1"));
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah / Edit About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h1>Tambah / Update About</h1>
    <?php if ($msg): ?><div class="alert alert-info"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Title</label>
            <input class="form-control" name="title" value="<?= htmlspecialchars($curr['title'] ?? '') ?>" required>
        </div>
        <div class="col-md-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($curr['description'] ?? '') ?></textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <?php if (!empty($curr['image'])): ?>
                <div class="mt-2">
                    <img src="uploads/<?= htmlspecialchars($curr['image']) ?>" alt="" style="max-width:150px;">
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label class="form-label">Birthday</label>
            <input type="date" name="birthday" class="form-control" value="<?= htmlspecialchars($curr['birthday'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Website</label>
            <input name="website" class="form-control" value="<?= htmlspecialchars($curr['website'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input name="phone" class="form-control" value="<?= htmlspecialchars($curr['phone'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">City</label>
            <input name="city" class="form-control" value="<?= htmlspecialchars($curr['city'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($curr['age'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Degree</label>
            <input name="degree" class="form-control" value="<?= htmlspecialchars($curr['degree'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($curr['email'] ?? '') ?>">
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="simpan">Save</button>
            <a class="btn btn-secondary" href="?page=about">Back</a>
        </div>
    </form>
</div>
</body>
</html>
