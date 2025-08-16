<?php
include 'koneksi.php';

$msg = '';
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

// Hapus data
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    if ($id > 0) {
        $stmt = $koneksi->prepare("DELETE FROM skills WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ?page=skills&hapus=berhasil");
        exit;
    }
}

// Ambil semua data skills
$skills = mysqli_query($koneksi, "SELECT * FROM skills ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Skills</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h2>Manage Skills</h2>

    <?php if ($msg): ?>
        <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <a href="?page=tambah-skills" class="btn btn-primary mb-3">+ Add Skill</a>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>%</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($skills)): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= intval($row['percentage']) ?>%</td>
                <td>
                    <a href="?page=tambah-skills&edit=<?= intval($row['id']) ?>" class="btn btn-sm btn-success">Edit</a>
                    <a href="?page=skills&delete=<?= intval($row['id']) ?>"
                       onclick="return confirm('Hapus skill ini?')"
                       class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
