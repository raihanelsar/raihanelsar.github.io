<?php
include 'koneksi.php';

// Create
if (isset($_POST['add'])) {
    $icon = mysqli_real_escape_string($koneksi, $_POST['icon']);
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    mysqli_query($koneksi, "INSERT INTO services (icon, title, description) VALUES ('$icon', '$title', '$description')");
}

// Delete
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    mysqli_query($koneksi, "DELETE FROM services WHERE id=$id");
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Services</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
  <h2>Services</h2>

  <form method="POST" class="row g-3">
      <div class="col-md-4">
        <input type="text" name="icon" class="form-control" placeholder="Icon class (e.g. bi bi-activity)" required>
      </div>
      <div class="col-md-4">
        <input type="text" name="title" class="form-control" placeholder="Service Title" required>
      </div>
      <div class="col-md-12">
        <textarea name="description" class="form-control" placeholder="Description" rows="3"></textarea>
      </div>
      <div class="col-12">
        <button type="submit" name="add" class="btn btn-primary">Add Service</button>
      </div>
  </form>

  <hr>

  <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Icon</th>
          <th>Title</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $q = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");
      while ($row = mysqli_fetch_assoc($q)) {
          echo "<tr>
              <td><i class='".htmlspecialchars($row['icon'])."'></i> <code>{$row['icon']}</code></td>
              <td>".htmlspecialchars($row['title'])."</td>
              <td>".nl2br(htmlspecialchars($row['description']))."</td>
              <td><a class='btn btn-sm btn-danger' href='?page=services&del={$row['id']}' onclick='return confirm(\"Delete this item?\")'>Delete</a></td>
          </tr>";
      }
      ?>
      </tbody>
  </table>
</div>
</body>
</html>