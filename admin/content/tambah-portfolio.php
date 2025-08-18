<?php
include 'koneksi.php';

$msg = "";

// =======================
// Ambil daftar kategori dari ENUM
// =======================
$catQ = mysqli_query($koneksi, "SHOW COLUMNS FROM portfolio LIKE 'category'");
$row = mysqli_fetch_assoc($catQ);
preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches);
$categories = explode("','", $matches[1]);

// =======================
// Proses form submit
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category    = mysqli_real_escape_string($koneksi, trim($_POST['category']));
    $title       = mysqli_real_escape_string($koneksi, trim($_POST['title']));
    $description = mysqli_real_escape_string($koneksi, trim($_POST['description']));
    $link        = mysqli_real_escape_string($koneksi, trim($_POST['link']));

    $img = null;

    // Upload gambar
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            $img = time() . "_" . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['image']['name']);
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $img);
        } else {
            $msg = "❌ Format file tidak diizinkan!";
        }
    }

    // Simpan ke database
    if ($img) {
        $sql = "INSERT INTO portfolio (category, title, description, image, link) 
                VALUES ('$category', '$title', '$description', '$img', '$link')";
        if (mysqli_query($koneksi, $sql)) {
            $msg = "✅ Portfolio berhasil ditambahkan!";
        } else {
            $msg = "❌ Gagal menambahkan: " . mysqli_error($koneksi);
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
<div class="container">
    <h1 class="mb-4">Tambah Portfolio</h1>

    <?php if ($msg): ?>
        <div class="alert alert-info"><?= $msg ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Kategori</label>
            <select name="category" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>"><?= ucfirst($cat) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-8">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Link Eksternal (opsional)</label>
            <input type="url" name="link" class="form-control" placeholder="https://...">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="?page=portfolio" class="btn btn-secondary">⬅ Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
