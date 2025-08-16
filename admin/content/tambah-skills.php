<?php
include 'koneksi.php';

$msg = '';
$editData = null;

// ===== CREATE =====
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $perc = filter_var($_POST['percentage'], FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 0, 'max_range' => 100]
    ]);

    if ($name !== '' && $perc !== false) {
        $stmt = $koneksi->prepare("INSERT INTO skills (name, percentage) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $perc);
        $stmt->execute();
        $stmt->close();
        header("Location: ?page=skills&tambah=berhasil");
        exit;
    } else {
        $msg = "Input tidak valid!";
    }
}

// ===== UPDATE =====
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $perc = filter_var($_POST['percentage'], FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 0, 'max_range' => 100]
    ]);

    if ($id > 0 && $name !== '' && $perc !== false) {
        $stmt = $koneksi->prepare("UPDATE skills SET name=?, percentage=? WHERE id=?");
        $stmt->bind_param("sii", $name, $perc, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ?page=skills&ubah=berhasil");
        exit;
    } else {
        $msg = "Input tidak valid!";
    }
}

// ===== DELETE =====
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

// ===== GET DATA FOR EDIT =====
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $stmt = $koneksi->prepare("SELECT * FROM skills WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $editData = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $editData ? 'Edit Skill' : 'Add Skill' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h2><?= $editData ? 'Edit Skill' : 'Add Skill' ?></h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST" class="row g-2 mb-3">
        <?php if ($editData): ?>
            <input type="hidden" name="id" value="<?= intval($editData['id']) ?>">
        <?php endif; ?>

        <div class="col-md-5">
            <input type="text" name="name" placeholder="Skill Name" class="form-control"
                   value="<?= $editData ? htmlspecialchars($editData['name']) : '' ?>" required>
        </div>
        <div class="col-md-3">
            <input type="number" name="percentage" min="0" max="100" placeholder="%" class="form-control"
                   value="<?= $editData ? intval($editData['percentage']) : '' ?>" required>
        </div>
        <div class="col-md-4">
            <?php if ($editData): ?>
                <button type="submit" name="update" class="btn btn-warning">Update Skill</button>
                <a href="?page=skills" class="btn btn-secondary">Cancel</a>
            <?php else: ?>
                <button type="submit" name="add" class="btn btn-primary">Add Skill</button>
                <a href="?page=skills" class="btn btn-secondary">Back</a>
            <?php endif; ?>
        </div>
    </form>
</div>
</body>
</html>
