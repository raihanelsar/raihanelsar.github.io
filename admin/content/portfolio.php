<?php
include 'koneksi.php';

// =======================
// HAPUS DATA
// =======================
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);

    // Ambil nama file gambar
    $stmt = mysqli_prepare($koneksi, "SELECT image FROM portfolio WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $filePath = "uploads/" . $row['image'];
        if (!empty($row['image']) && file_exists($filePath)) {
            unlink($filePath); // hapus file gambar fisik
        }
    }
    mysqli_stmt_close($stmt);

    // Hapus data dari DB
    $stmt = mysqli_prepare($koneksi, "DELETE FROM portfolio WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ?page=portfolio&msg=deleted");
    exit;
}

// =======================
// AMBIL SEMUA DATA
// =======================
$portfolio = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manajemen Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h1 class="mb-4">Manajemen Portfolio</h1>

    <!-- Pesan Notifikasi -->
    <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert alert-success alert-dismissible fade show">
            Data berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tombol Tambah -->
    <a href="?page=tambah-portfolio" class="btn btn-primary mb-3">+ Tambah Portfolio</a>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width:50px">#</th>
                    <th style="width:80px">Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th style="width:150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1; 
            if (mysqli_num_rows($portfolio) > 0):
                while ($row = mysqli_fetch_assoc($portfolio)): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td>
                        <?php if (!empty($row['image']) && file_exists("uploads/" . $row['image'])): ?>
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Preview" style="height:50px">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td>
                        <a href="?page=tambah-portfolio&edit=<?= $row['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                        <a href="?page=portfolio&del=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; 
            else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data portfolio</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
