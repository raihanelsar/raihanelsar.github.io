<?php include 'header.php'; ?>

<?php
// Save or update single record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($koneksi, $_POST['address']);
    $phone   = mysqli_real_escape_string($koneksi, $_POST['phone']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);
    $map     = mysqli_real_escape_string($koneksi, $_POST['map_embed']);

    $check = mysqli_query($koneksi, "SELECT id FROM contact LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $id = $row['id'];
        mysqli_query($koneksi, "UPDATE contact SET address='$address', phone='$phone', email='$email', map_embed='$map' WHERE id=$id");
    } else {
        mysqli_query($koneksi, "INSERT INTO contact (address, phone, email, map_embed) VALUES ('$address', '$phone', '$email', '$map')");
    }
}

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM contact LIMIT 1"));
?>

<h2>Contact</h2>

<form method="POST">
    <textarea name="address" rows="3" placeholder="Address"><?php echo @$data['address']; ?></textarea><br>
    <input type="text" name="phone" placeholder="Phone" value="<?php echo @$data['phone']; ?>"><br>
    <input type="email" name="email" placeholder="Email" value="<?php echo @$data['email']; ?>"><br>
    <textarea name="map_embed" rows="4" placeholder='Google Maps embed iframe code'><?php echo @$data['map_embed']; ?></textarea><br>
    <button type="submit">Save Contact</button>
</form>

<?php include 'footer.php'; ?>
