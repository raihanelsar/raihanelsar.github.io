<?php
include 'koneksi.php';
include '_helpers.php';

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM resume WHERE id = $id");
    header("Location: ?page=resume&status=deleted");
    exit;
}

$rows = mysqli_query($koneksi, "SELECT * FROM resume ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Resume List</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
<h1>Resume List</h1>

<?php if (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
<div class="alert alert-success">Data berhasil dihapus!</div>
<?php endif; ?>

<a class="btn btn-primary mb-3" href="?page=tambah-resume">+ Add Resume Item</a>
<table class="table table-bordered">
<thead>
<tr>
    <th>#</th>
    <th>Section</th>
    <th>Title</th>
    <th>Subtitle</th>
    <th>Years</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; while ($r = mysqli_fetch_assoc($rows)): ?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($r['section_type']) ?></td>
    <td><?= htmlspecialchars($r['title']) ?></td>
    <td><?= htmlspecialchars($r['subtitle']) ?></td>
    <td><?= htmlspecialchars($r['year_start'] . ' - ' . $r['year_end']) ?></td>
    <td>
        <a class="btn btn-sm btn-warning" href="?page=tambah-resume&edit=<?= $r['id'] ?>">Edit</a>
        <a class="btn btn-sm btn-danger" href="?page=resume&delete=<?= $r['id'] ?>" onclick="return confirm('Delete this item?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</body>
</html>
