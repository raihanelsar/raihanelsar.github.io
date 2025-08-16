<?php
?>
<?php
function clean($koneksi, $s) { return mysqli_real_escape_string($koneksi, trim($s)); }
function save_upload($field, $destDir) {
  if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return null;
  if (!is_dir($destDir)) mkdir($destDir, 0777, true);
  $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
  $fname = uniqid('up_') . ($ext ? ('.' . strtolower($ext)) : '');
  move_uploaded_file($_FILES[$field]['tmp_name'], $destDir . '/' . $fname);
  return $fname;
}
?>