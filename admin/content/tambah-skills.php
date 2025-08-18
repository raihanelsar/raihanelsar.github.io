<?php
include 'koneksi.php';

$msg = '';
$editData = null;

// ===== CREATE =====
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $subcategory = $_POST['subcategory'] ?? '';
    $perc = intval($_POST['percentage']);

    if ($name !== '' && $category !== '' && $perc >= 0 && $perc <= 100) {
        $stmt = $koneksi->prepare("INSERT INTO skills (name, category, subcategory, percentage) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $category, $subcategory, $perc);
        $stmt->execute();
        $stmt->close();
        header("Location: ?page=skills&msg=tambah-berhasil");
        exit;
    } else {
        $msg = "Input tidak valid!";
    }
}

// ===== UPDATE =====
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $subcategory = $_POST['subcategory'] ?? '';
    $perc = intval($_POST['percentage']);

    if ($id > 0 && $name !== '' && $category !== '' && $perc >= 0 && $perc <= 100) {
        $stmt = $koneksi->prepare("UPDATE skills SET name=?, category=?, subcategory=?, percentage=? WHERE id=?");
        $stmt->bind_param("sssii", $name, $category, $subcategory, $perc, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ?page=skills&msg=ubah-berhasil");
        exit;
    } else {
        $msg = "Input tidak valid!";
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
    <h2 class="mb-3"><?= $editData ? 'Edit Skill' : 'Add Skill' ?></h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST" class="row g-3 mb-3">
        <?php if ($editData): ?>
            <input type="hidden" name="id" value="<?= intval($editData['id']) ?>">
        <?php endif; ?>

        <div class="col-md-4">
            <label class="form-label">Skill Name</label>
            <input type="text" name="name" class="form-control"
                   value="<?= $editData ? htmlspecialchars($editData['name']) : '' ?>" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Category</label>
            <select name="category" id="category" class="form-select" required onchange="toggleSubcategory(this.value)">
                <option value="">-- Select Category --</option>
                <option value="Programming" <?= ($editData && $editData['category']=="Programming") ? "selected" : "" ?>>Programming</option>
                <option value="Design" <?= ($editData && $editData['category']=="Design") ? "selected" : "" ?>>Design</option>
                <option value="Tools" <?= ($editData && $editData['category']=="Tools") ? "selected" : "" ?>>Tools</option>
                <option value="Soft Skills" <?= ($editData && $editData['category']=="Soft Skills") ? "selected" : "" ?>>Soft Skills</option>
            </select>
        </div>

        <div class="col-md-3" id="subcategory-wrapper" style="display:none;">
            <label class="form-label">Subcategory</label>
            <select name="subcategory" id="subcategory" class="form-select">
                <option value="">-- Select Subcategory --</option>
                <option value="Front-End" <?= ($editData && $editData['subcategory']=="Front-End") ? "selected" : "" ?>>Front-End</option>
                <option value="Back-End" <?= ($editData && $editData['subcategory']=="Back-End") ? "selected" : "" ?>>Back-End</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Percentage: <span id="percVal"><?= $editData ? intval($editData['percentage']) : 50 ?></span>%</label>
            <input type="range" name="percentage" min="0" max="100" step="1"
                   class="form-range"
                   value="<?= $editData ? intval($editData['percentage']) : 50 ?>"
                   oninput="document.getElementById('percVal').innerText=this.value">
        </div>

        <div class="col-md-12">
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

<script>
function toggleSubcategory(category) {
    const wrapper = document.getElementById('subcategory-wrapper');
    if (category === 'Programming') {
        wrapper.style.display = 'block';
    } else {
        wrapper.style.display = 'none';
        document.getElementById('subcategory').value = '';
    }
}

// jalankan saat halaman dibuka (edit mode)
document.addEventListener("DOMContentLoaded", function(){
    toggleSubcategory(document.getElementById('category').value);
});
</script>
</body>
</html>
