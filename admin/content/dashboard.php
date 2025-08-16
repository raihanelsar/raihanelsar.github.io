<?php
?>
<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
  <div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    <div class="list-group">
      <a class="list-group-item" href="?page=tambah-about">Add / Update About</a>
      <a class="list-group-item" href="?page=tambah-statistics">Add Statistic</a>
      <a class="list-group-item" href="?page=tambah-skills">Add Skill</a>
      <a class="list-group-item" href="?page=tambah-resume">Add Resume Item</a>
      <a class="list-group-item" href="?page=tambah-portfolio">Add Portfolio Item</a>
      <a class="list-group-item" href="?page=tambah-services">Add Service</a>
      <a class="list-group-item" href="?page=tambah-contact">Add / Update Contact</a>
    </div>
  </div>
</body>
</html>
