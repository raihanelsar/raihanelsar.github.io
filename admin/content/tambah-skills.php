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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $editData ? 'Edit Skill' : 'Add Skill' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .form-label i {
            color: #0d6efd;
            margin-right: 6px;
        }

        .progress {
            height: 24px;
            border-radius: 8px;
        }

        .progress-bar {
            font-weight: bold;
            font-size: 13px;
        }
    </style>
</head>

<body class="p-4">
    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-primary mb-0">
                    <i class="bi bi-award-fill"></i> <?= $editData ? 'Edit Skill' : 'Add New Skill' ?>
                </h4>
                <a href="?page=skills" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <?php if ($msg): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($msg) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" class="row g-3">
                <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= intval($editData['id']) ?>">
                <?php endif; ?>

                <!-- Name -->
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-pencil-square"></i> Skill Name</label>
                    <input type="text" name="name" class="form-control"
                        value="<?= $editData ? htmlspecialchars($editData['name']) : '' ?>" required>
                </div>

                <!-- Category -->
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-grid-1x2"></i> Category</label>
                    <select name="category" id="category" class="form-select" required onchange="toggleSubcategory(this.value)">
                        <option value="">-- Select Category --</option>
                        <option value="Programming" <?= ($editData && $editData['category'] == "Programming") ? "selected" : "" ?>>
                            Programming</option>
                        <option value="Design" <?= ($editData && $editData['category'] == "Design") ? "selected" : "" ?>>Design
                        </option>
                        <option value="Tools" <?= ($editData && $editData['category'] == "Tools") ? "selected" : "" ?>>Tools
                        </option>
                        <option value="Soft Skills" <?= ($editData && $editData['category'] == "Soft Skills") ? "selected" : "" ?>>
                            Soft Skills</option>
                    </select>
                </div>

                <!-- Subcategory -->
                <div class="col-md-6" id="subcategory-wrapper" style="display:none;">
                    <label class="form-label"><i class="bi bi-diagram-3"></i> Subcategory</label>
                    <select name="subcategory" id="subcategory" class="form-select">
                        <option value="">-- Select Subcategory --</option>
                        <option value="Front-End" <?= ($editData && $editData['subcategory'] == "Front-End") ? "selected" : "" ?>>
                            Front-End</option>
                        <option value="Back-End" <?= ($editData && $editData['subcategory'] == "Back-End") ? "selected" : "" ?>>
                            Back-End</option>
                    </select>
                </div>

                <!-- Percentage -->
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-graph-up"></i> Proficiency</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="range" name="percentage" min="0" max="100" step="1" class="form-range flex-grow-1"
                            value="<?= $editData ? intval($editData['percentage']) : 50 ?>" oninput="updatePerc(this.value)">
                        <span class="badge bg-primary fs-6"
                            id="percVal"><?= $editData ? intval($editData['percentage']) : 50 ?>%</span>
                    </div>
                    <div class="progress mt-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="percBar"
                            style="width: <?= $editData ? intval($editData['percentage']) : 50 ?>%">
                            <?= $editData ? intval($editData['percentage']) : 50 ?>%
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="col-12 mt-3">
                    <?php if ($editData): ?>
                        <button type="submit" name="update" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Update Skill
                        </button>
                        <a href="?page=skills" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    <?php else: ?>
                        <button type="submit" name="add" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Skill
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

        function updatePerc(val) {
            document.getElementById('percVal').innerText = val + '%';
            document.getElementById('percBar').style.width = val + '%';
            document.getElementById('percBar').innerText = val + '%';
        }

        // jalankan saat halaman dibuka (edit mode)
        document.addEventListener("DOMContentLoaded", function() {
            toggleSubcategory(document.getElementById('category').value);
        });
    </script>
</body>

</html>