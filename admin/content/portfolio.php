<?php
include 'koneksi.php';

// =======================
// Hapus data portfolio
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
            unlink($filePath);
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
// Ambil semua data
// =======================
$portfolio = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Manajemen Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">📂 Manajemen Portfolio</h1>

    <!-- Pesan Notifikasi -->
    <?php if (!empty($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
        <div class="alert alert-success alert-dismissible fade show">
            ✅ Data berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="?page=tambah-portfolio" class="btn btn-primary">+ Tambah Portfolio</a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th style="width:50px">#</th>
                    <th style="width:80px">Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tags</th>
                    <th>Link</th>
                    <th style="width:200px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1; 
            if (mysqli_num_rows($portfolio) > 0):
                while ($row = mysqli_fetch_assoc($portfolio)): ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center">
                        <?php if (!empty($row['image']) && file_exists("uploads/" . $row['image'])): ?>
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" 
                                 alt="Preview" class="img-thumbnail" style="height:50px">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td>
                        <?php if (!empty($row['tags'])): ?>
                            <?php foreach (explode(',', $row['tags']) as $tag): ?>
                                <span class="badge bg-info text-dark"><?= htmlspecialchars(trim($tag)) ?></span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if (!empty($row['link'])): ?>
                            <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="btn btn-outline-primary btn-sm">🔗 Lihat</a>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="?page=tambah-portfolio&edit=<?= $row['id'] ?>" class="btn btn-success btn-sm">✏ Edit</a>
                        <a href="?page=portfolio&del=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">🗑 Hapus</a>
                    </td>
                </tr>
            <?php endwhile; 
            else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data portfolio</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
