<?php
include 'koneksi.php';
include '_helpers.php';

$msg = '';
$editData = null;
$editId = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

// Fetch data for editing
if ($editId > 0) {
    $result = mysqli_query($koneksi, "SELECT * FROM resume WHERE id = $editId");
    if ($result && mysqli_num_rows($result) > 0) {
        $editData = mysqli_fetch_assoc($result);
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section_type = clean($koneksi, $_POST['section_type'] ?? 'education');
    $title        = clean($koneksi, $_POST['title'] ?? '');
    $subtitle     = clean($koneksi, $_POST['subtitle'] ?? '');
    $year_start   = intval($_POST['year_start'] ?? 0);
    $year_end     = intval($_POST['year_end'] ?? 0);
    $description  = clean($koneksi, $_POST['description'] ?? '');
    $link         = clean($koneksi, $_POST['link'] ?? '');

    if (isset($_POST['update_id']) && intval($_POST['update_id']) > 0) {
        // Update
        $updateId = intval($_POST['update_id']);
        mysqli_query(
            $koneksi,
            "UPDATE resume SET 
                section_type='$section_type',
                title='$title',
                subtitle='$subtitle',
                year_start='$year_start',
                year_end='$year_end',
                description='$description',
                link='$link'
            WHERE id=$updateId"
        );
        $msg = 'Resume item updated!';
    } else {
        // Insert
        mysqli_query(
            $koneksi,
            "INSERT INTO resume (section_type, title, subtitle, year_start, year_end, description, link)
            VALUES ('$section_type', '$title', '$subtitle', '$year_start', '$year_end', '$description', '$link')"
        );
        $msg = 'Resume item added!';
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
</head>
<body class="p-4">
<div class="container">
<h1><?= $editData ? 'Edit' : 'Add' ?> Resume Item</h1>

<form method="post" class="row g-3">
  <?php if ($editData): ?>
    <input type="hidden" name="update_id" value="<?= $editData['id'] ?>">
  <?php endif; ?>
  <div class="col-md-4">
    <label class="form-label">Section</label>
    <select name="section_type" class="form-select">
      <?php
      $sections = ['education', 'organization', 'experience'];
      foreach ($sections as $sec) {
          $sel = ($editData && $editData['section_type'] == $sec) ? 'selected' : '';
          echo "<option value='$sec' $sel>" . ucfirst($sec) . "</option>";
      }
      ?>
    </select>
  </div>
  <div class="col-md-8">
    <label class="form-label">Title</label>
    <input class="form-control" name="title" value="<?= htmlspecialchars($editData['title'] ?? '') ?>" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Subtitle</label>
    <input class="form-control" name="subtitle" value="<?= htmlspecialchars($editData['subtitle'] ?? '') ?>">
  </div>
  <div class="col-md-3">
    <label class="form-label">Year Start</label>
    <input type="number" class="form-control" name="year_start" value="<?= htmlspecialchars($editData['year_start'] ?? '') ?>" placeholder="2020">
  </div>
  <div class="col-md-3">
    <label class="form-label">Year End</label>
    <input type="number" class="form-control" name="year_end" value="<?= htmlspecialchars($editData['year_end'] ?? '') ?>" placeholder="2024">
  </div>
  <div class="col-md-12">
    <label class="form-label">Description</label>
    <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($editData['description'] ?? '') ?></textarea>
  </div>
  <div class="col-md-12">
    <label class="form-label">Link</label>
    <input class="form-control" name="link" value="<?= htmlspecialchars($editData['link'] ?? '') ?>" placeholder="https://...">
  </div>
  <div class="col-12">
    <button class="btn btn-primary"><?= $editData ? 'Update' : 'Add' ?></button>
    <a class="btn btn-secondary" href="?page=resume">Back</a>
  </div>
</form>

</div>
</body>
</html>
