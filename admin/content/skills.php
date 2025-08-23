<?php
include 'koneksi.php';

$msg = '';
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

// ===== DELETE =====
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id > 0) {
        $stmt = $koneksi->prepare("DELETE FROM skills WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ?page=skills&msg=hapus-berhasil");
        exit;
    }
}

// ===== GET ALL SKILLS =====
$skills = mysqli_query($koneksi, "SELECT * FROM skills ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Skills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .progress {
            height: 22px;
            border-radius: 8px;
        }

        .progress-bar {
            font-weight: bold;
            font-size: 13px;
        }

        table th,
        table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>

<body class="p-4">
    <div class="container bg-white p-4 rounded shadow-sm">
        <div class="page-header mb-3">
            <h3 class="fw-bold text-primary">📊 Manage Skills</h3>
            <a href="?page=tambah-skills" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Skill
            </a>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($msg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th width="20%">Name</th>
                        <th width="20%">Category</th>
                        <th width="20%">Subcategory</th>
                        <th width="25%">Level</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($skills) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($skills)): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['category']) ?></td>
                                <td><?= $row['subcategory'] ? htmlspecialchars($row['subcategory']) : '<span class="text-muted">-</span>' ?>
                                </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                            style="width: <?= intval($row['percentage']) ?>%">
                                            <?= intval($row['percentage']) ?>%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="?page=tambah-skills&edit=<?= intval($row['id']) ?>" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="?page=skills&delete=<?= intval($row['id']) ?>" onclick="return confirm('Hapus skill ini?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data skill</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>

</html>