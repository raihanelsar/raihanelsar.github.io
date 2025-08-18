<?php
include 'koneksi.php';

// Cek jika edit
$editData = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM resume WHERE id=$id");
    $editData = mysqli_fetch_assoc($query);
}

// Proses simpan/update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section_type = $_POST['section_type'];
    $title        = $_POST['title'];
    $subtitle     = $_POST['subtitle'];
    $year_start   = $_POST['year_start'];
    $year_end     = $_POST['year_end'];
    $description  = $_POST['description'];
    $link         = $_POST['link'];

    if (isset($_POST['update_id'])) {
        $update_id = intval($_POST['update_id']);
        $sql = "UPDATE resume 
                SET section_type=?, title=?, subtitle=?, year_start=?, year_end=?, description=?, link=? 
                WHERE id=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $section_type, $title, $subtitle, $year_start, $year_end, $description, $link, $update_id);
        mysqli_stmt_execute($stmt);
    } else {
        $sql = "INSERT INTO resume (section_type, title, subtitle, year_start, year_end, description, link) 
                VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $section_type, $title, $subtitle, $year_start, $year_end, $description, $link);
        mysqli_stmt_execute($stmt);
    }

    header("Location: ?page=resume");
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $editData ? 'Edit' : 'Add' ?> Resume Item</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="p-4">
<div class="container">
<h1><i class="bi bi-pencil-square"></i> <?= $editData ? 'Edit' : 'Add' ?> Resume Item</h1>

<form method="post" class="row g-3">
  <?php if ($editData): ?>
    <input type="hidden" name="update_id" value="<?= $editData['id'] ?>">
  <?php endif; ?>
  
  <!-- Section -->
  <div class="col-md-4">
    <label class="form-label"><i class="bi bi-list-task"></i> Section</label>
    <select name="section_type" class="form-select">
      <?php
      $sections = ['education', 'organization', 'experience', 'certification'];
      foreach ($sections as $sec) {
          $sel = ($editData && $editData['section_type'] == $sec) ? 'selected' : '';
          echo "<option value='$sec' $sel>" . ucfirst($sec) . "</option>";
      }
      ?>
    </select>
  </div>

  <!-- Title -->
  <div class="col-md-8">
    <label class="form-label"><i class="bi bi-type-bold"></i> Title</label>
    <input class="form-control" name="title" value="<?= htmlspecialchars($editData['title'] ?? '') ?>" required>
  </div>

  <!-- Subtitle -->
  <div class="col-md-6">
    <label class="form-label"><i class="bi bi-journal-text"></i> Subtitle</label>
    <input class="form-control" name="subtitle" value="<?= htmlspecialchars($editData['subtitle'] ?? '') ?>">
  </div>

  <!-- Year Start -->
  <div class="col-md-3">
    <label class="form-label"><i class="bi bi-calendar-event"></i> Year Start</label>
    <input type="number" class="form-control" name="year_start" value="<?= htmlspecialchars($editData['year_start'] ?? '') ?>" placeholder="2020">
  </div>

  <!-- Year End -->
  <div class="col-md-3">
    <label class="form-label"><i class="bi bi-calendar-check"></i> Year End</label>
    <input type="number" class="form-control" name="year_end" value="<?= htmlspecialchars($editData['year_end'] ?? '') ?>" placeholder="2024">
  </div>

  <!-- Description -->
  <div class="col-md-12">
    <label class="form-label"><i class="bi bi-text-paragraph"></i> Description</label>
    <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($editData['description'] ?? '') ?></textarea>
  </div>

  <!-- Link -->
  <div class="col-md-12">
    <label class="form-label"><i class="bi bi-link-45deg"></i> Link</label>
    <input class="form-control" name="link" value="<?= htmlspecialchars($editData['link'] ?? '') ?>" placeholder="https://...">
  </div>

  <!-- Buttons -->
  <div class="col-12">
    <button class="btn btn-primary"><i class="bi bi-save"></i> <?= $editData ? 'Update' : 'Add' ?></button>
    <a class="btn btn-secondary" href="?page=resume"><i class="bi bi-arrow-left"></i> Back</a>
  </div>
</form>
</div>
</body>
</html>
