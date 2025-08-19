<?php
include 'koneksi.php';
include '_helpers.php';

// Handle delete (lebih aman pakai prepared statement)
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = mysqli_prepare($koneksi, "DELETE FROM resume WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: ?page=resume&status=deleted");
    exit;
}

// Ambil semua data resume
$rows = mysqli_query($koneksi, "SELECT * FROM resume ORDER BY id DESC");
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Resume List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .table td {
            vertical-align: middle;
        }

        .desc-cell {
            max-width: 250px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>

<body class="p-4">
    <div class="container">
        <h1>Resume List</h1>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
            <div class="alert alert-success">Data berhasil dihapus!</div>
        <?php endif; ?>

        <a class="btn btn-primary mb-3" href="?page=tambah-resume">+ Add Resume Item</a>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Section</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Years</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($r = mysqli_fetch_assoc($rows)): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= ucfirst(htmlspecialchars($r['section_type'])) ?></td>
                        <td><?= htmlspecialchars($r['title']) ?></td>
                        <td><?= htmlspecialchars($r['subtitle'] ?: '-') ?></td>
                        <td>
                            <?= ($r['year_start'] ? htmlspecialchars($r['year_start']) : '-') ?>
                            -
                            <?= ($r['year_end'] ? htmlspecialchars($r['year_end']) : '-') ?>
                        </td>
                        <td class="desc-cell"><?= !empty($r['description']) ? htmlspecialchars($r['description']) : '-' ?></td>
                        <td>
                            <?php if (!empty($r['link'])): ?>
                                <a href="<?= htmlspecialchars($r['link']) ?>" target="_blank">View</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="?page=tambah-resume&id=<?= $r['id'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="?page=resume&delete=<?= $r['id'] ?>"
                                onclick="return confirm('Delete this item?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>