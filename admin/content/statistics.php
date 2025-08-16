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
    if ($_GET['msg'] === 'deleted') {
        $msg = '<div class="alert alert-success">Data berhasil dihapus.</div>';
    } elseif ($_GET['msg'] === 'failed') {
        $msg = '<div class="alert alert-danger">Gagal menghapus data.</div>';
    } elseif ($_GET['msg'] === 'saved') {
        $msg = '<div class="alert alert-success">Data berhasil disimpan.</div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Statistics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Data Statistics</h2>
    <?= $msg ?>

    <a href="?page=tambah-statistics" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Icon</th>
                <th>Value</th>
                <th>Label</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><i class="<?= htmlspecialchars($row['icon']) ?>"></i> <?= htmlspecialchars($row['icon']) ?></td>
                <td><?= $row['value'] ?></td>
                <td><?= htmlspecialchars($row['label']) ?></td>
                <td>
                    <a href="?page=tambah-statistics&edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?page=statistics&delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
