<?php
include 'koneksi.php';

// Ambil data kontak (hanya 1 record terakhir)
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact ORDER BY id DESC LIMIT 1"));
?>

<h2>Contact</h2>

<?php if ($data): ?>
    <p><strong>Address:</strong><br><?= htmlspecialchars($data['address']) ?></p>
    <p><strong>Phone:</strong><br><?= htmlspecialchars($data['phone']) ?></p>
    <p><strong>Email:</strong><br><?= htmlspecialchars($data['email']) ?></p>

    <?php if (!empty($data['map_embed'])): ?>
        <div class="map-embed" style="margin-top:15px;">
            <?= $data['map_embed'] ?>
        </div>
    <?php endif; ?>
<?php else: ?>
    <p>No contact data available.</p>
<?php endif; ?>
