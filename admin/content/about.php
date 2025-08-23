<?php
include 'koneksi.php';

// Ambil data dari tabel about
$rows = [];
$query = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
if ($query) {
    while ($r = mysqli_fetch_assoc($query)) {
        $rows[] = $r;
    }
}
?>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Gambar</th>
      <th>Judul</th>
      <th>Deskripsi</th>
      <th>Birthday</th>
      <th>Website</th>
      <th>Phone</th>
      <th>City</th>
      <th>Age</th>
      <th>Degree</th>
      <th>Email</th>
      <th>CV</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($rows)): ?>
      <?php foreach ($rows as $key => $row): ?>
        <tr>
          <td><?= $key + 1 ?></td>
          <td>
            <?php if (!empty($row['image'])): ?>
              <img src="uploads/<?= htmlspecialchars($row['image']) ?>" width="100">
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td><?= htmlspecialchars($row['birthday']) ?></td>
          <td><?= htmlspecialchars($row['website']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['city']) ?></td>
          <td><?= htmlspecialchars($row['age']) ?></td>
          <td><?= htmlspecialchars($row['degree']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td>
            <?php if (!empty($row['cv'])): ?>
              <a href="uploads/<?= htmlspecialchars($row['cv']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat CV</a>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="?page=tambah-about&edit=<?= $row['id'] ?>" class="btn btn-sm btn-success">Edit</a>
            <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" href="?page=tambah-about&delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="13" class="text-center">Tidak ada data</td></tr>
    <?php endif; ?>
  </tbody>
</table>
