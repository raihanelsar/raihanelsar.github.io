<?php
include 'koneksi.php';

// Ambil semua data dari tabel about
$query = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>Data About</h1>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data About</h5>

          <div class="mb-3 text-end">
            <a href="?page=tambah-about" class="btn btn-primary">Tambah</a>
          </div>

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>PDF</th>
                <th>Title</th>
                <th>Description</th>
                <th>Birthday</th>
                <th>Website</th>
                <th>Phone</th>
                <th>City</th>
                <th>Age</th>
                <th>Degree</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $key => $row): ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td>
                      <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['image']) ?>" width="100" alt="">
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if (!empty($row['pdf'])): ?>
                        <a href="uploads/<?= htmlspecialchars($row['pdf']) ?>" target="_blank">Lihat PDF</a>
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
                      <?php
                      if (isset($row['is_active'])) {
                        echo $row['is_active']
                          ? "<span class='badge bg-success'>Aktif</span>"
                          : "<span class='badge bg-secondary'>Nonaktif</span>";
                      }
                      ?>
                    </td>
                    <td>
                      <a href="?page=tambah-about&edit=<?= $row['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                      <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"
                        href="?page=tambah-about&delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="14" class="text-center">Tidak ada data</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>