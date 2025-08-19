<?php
include 'koneksi.php';

// Hapus data
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (mysqli_query($koneksi, "DELETE FROM statistics WHERE id = $id")) {
        header("Location: ?page=statistics&msg=deleted");
        exit;
    } else {
        header("Location: ?page=statistics&msg=failed");
        exit;
    }
}

// Ambil data
$result = mysqli_query($koneksi, "SELECT * FROM statistics ORDER BY id ASC");

// Notifikasi
$msg = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'deleted':
            $msg = '<div class="alert alert-success">✅ Data berhasil dihapus.</div>';
            break;
        case 'failed':
            $msg = '<div class="alert alert-danger">❌ Gagal menghapus data.</div>';
            break;
        case 'saved':
            $msg = '<div class="alert alert-success">✅ Data berhasil disimpan.</div>';
            break;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Kelola Statistics - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Kelola Data Statistics</h2>
        <?= $msg ?>

        <a href="?page=tambah-statistics" class="btn btn-primary mb-3">+ Tambah Data</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Icon</th>
                        <th width="15%">Value</th>
                        <th>Label</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td class="text-center"><?= $row['id'] ?></td>
                                <td><i class="<?= htmlspecialchars($row['icon']) ?>"></i> <?= htmlspecialchars($row['icon']) ?></td>
                                <td class="text-center"><?= $row['value'] ?></td>
                                <td><?= htmlspecialchars($row['label']) ?></td>
                                <td class="text-center">
                                    <a href="?page=tambah-statistics&edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                                    <a href="?page=statistics&delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data ini?')">🗑 Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>