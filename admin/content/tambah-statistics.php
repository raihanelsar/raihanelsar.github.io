<?php
include 'koneksi.php';

$msg = '';
$editData = null;
$idEdit = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

// Ambil data untuk edit
if ($idEdit > 0) {
    $res = mysqli_query($koneksi, "SELECT * FROM statistics WHERE id = $idEdit");
    if ($res && mysqli_num_rows($res) > 0) {
        $editData = mysqli_fetch_assoc($res);
    } else {
        $msg = '<div class="alert alert-danger">❌ Data tidak ditemukan.</div>';
        $idEdit = 0;
    }
}

// Simpan / Update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $icon  = mysqli_real_escape_string($koneksi, $_POST['icon'] ?: 'bi bi-emoji-smile');
    $value = intval($_POST['value'] ?? 0);
    $label = mysqli_real_escape_string($koneksi, $_POST['label'] ?? '');

    if ($label !== '') {
        if ($idEdit > 0) {
            $sql = "UPDATE statistics SET icon='$icon', value=$value, label='$label' WHERE id=$idEdit";
        } else {
            $sql = "INSERT INTO statistics (icon, value, label) VALUES ('$icon', $value, '$label')";
        }

        if (mysqli_query($koneksi, $sql)) {
            header("Location: ?page=statistics&msg=saved");
            exit;
        } else {
            $msg = '<div class="alert alert-danger">❌ Gagal menyimpan data.</div>';
        }
    } else {
        $msg = '<div class="alert alert-warning">⚠ Label tidak boleh kosong.</div>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $idEdit > 0 ? 'Edit' : 'Tambah' ?> Statistic - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3"><?= $idEdit > 0 ? 'Edit' : 'Tambah' ?> Statistic</h2>
        <?= $msg ?>

        <form method="post" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Icon (Bootstrap Icon class)</label>
                <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($editData['icon'] ?? '') ?>"
                    placeholder="contoh: bi bi-star">
            </div>
            <div class="mb-3">
                <label class="form-label">Value</label>
                <input type="number" name="value" class="form-control" value="<?= htmlspecialchars($editData['value'] ?? 0) ?>"
                    min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Label</label>
                <input type="text" name="label" class="form-control" value="<?= htmlspecialchars($editData['label'] ?? '') ?>"
                    required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="?page=statistics" class="btn btn-secondary">⬅ Kembali</a>
                <button type="submit" class="btn btn-success">💾 Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>