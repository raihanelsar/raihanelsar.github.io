<?php
include 'koneksi.php';

// Ambil semua data dari tabel about
$query = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="pagetitle">
  <h1>Data Tentang Kami</h1>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Tentang Kami</h5>

          <div class="mb-3" align="right">
            <a href="?page=tambah-about" class="btn btn-primary">Tambah</a>
          </div>
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
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $key => $row): ?>
                  <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="100" alt=""></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['birthday']); ?></td>
                    <td><?php echo htmlspecialchars($row['website']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                    <td><?php echo htmlspecialchars($row['degree']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                      <?php
                      if (isset($row['is_active'])) {
                        echo $row['is_active'] ? "<span class='badge bg-success'>Aktif</span>" : "<span class='badge bg-secondary'>Nonaktif</span>";
                      }
                      ?>
                    </td>
                    <td>
                      <a href="?page=tambah-about&edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                      <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"
                        href="?page=tambah-about&delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="13" class="text-center">Tidak ada data</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>
