<?php
require './config/koneksi.php';
cek_login();

// deklarasi variable pesan
$message = false;
$message_status = false;

// cek apakah ada data yang di submit
if (isset($_POST['submit'])) {
  // ambil data dan simpan ke dalam variable
  $nama = $_POST['nama'];
  $tahun = $_POST['tahun'];
  $rating = $_POST['rating'];
  $deskripsi = $_POST['deskripsi'];
  $genre = $_POST['genre'];
  $negara = $_POST['negara'];
  $query = "";


  // cek apakah datanya di tambah atau di update dengan mengecek deskripsi url
  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "UPDATE film SET nama='$nama', deskripsi='$deskripsi', genre_id='$genre', negara_id='$negara', tahun='$tahun', rating='$rating' WHERE id='$id'";
  }
  // jika tidak ada data yang di kirim di url maka data di tambah
  else {
    $query = "INSERT INTO `film` (`id`, `negara_id`, `genre_id`, `nama`, `rating`, `tahun`, `deskripsi`) VALUES
    (NULL, '$negara', '$genre', '$nama',  '$rating', '$tahun', '$deskripsi')";
  }
  $result = mysqli_query($conn, $query);

  // buat pesan untuk menandakan query berhasil atau tidak
  $message = $result ? "Data berhasil disimpan" : "Data gagal disimpan";
  $message_status = $result;
}

$id = '';
$nama = '';
$deskripsi = '';
$genre = '';
$negara = '';
$tahun = '';
$rating = '';
$title = 'Tambah';
// cek jika halaman ini untuk edit data
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $title = 'Ubah';

  // mengambil data dari database
  $result = mysqli_query($conn, "SELECT * FROM film WHERE id='$id'");
  $data = mysqli_fetch_assoc($result);
  // jika data di temukan maka simpan ke dalam variable yang sudah ada.
  if ($data) {
    $nama = $data['nama'];
    $deskripsi = $data['deskripsi'];
    $tahun = $data['tahun'];
    $rating = $data['rating'];
    $genre = $data['genre_id'];
    $negara = $data['negara_id'];
  }
}
?>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?> Data Film | CRUD Data Film</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- bootstrap template -->

  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php">CRUD Data Film</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./negara.php">Penulis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./genre.php">Genre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./film.php">Film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <main class="container">
    <?php if ($message) : ?>
      <div class="alert alert-<?= $message_status ? 'success' : 'danger' ?> alert-dismissible fade show mt-2" role="alert">
        <strong><?= $message_status ? 'Berhasil' : 'Gagal' ?></strong> <?= $message ?>
      </div>
    <?php endif; ?>
    <div class="card shadow mt-3">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <label class="h6"><?= $title ?> Data Film</label>
          <a href="./film.php" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="nama">Nama Film</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama ?>" placeholder="Nama Film" required>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="negara">Penulis</label>
                <select class="form-control" name="negara" id="negara">
                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM negara");
                  while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id'] == $negara ? 'selected' : '';
                    echo "<option value='{$row['id']}' {$selected}>{$row['nama']}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="genre">Genre</label>
                <select class="form-control" name="genre" id="genre">
                  <?php
                  $result = mysqli_query($conn, "SELECT * FROM genre");
                  while ($row = mysqli_fetch_assoc($result)) {
                    $selected = $row['id'] == $genre ? 'selected' : '';
                    echo "<option value='{$row['id']}' {$selected}>{$row['nama']}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="tahun">Tahun Terbit</label>
            <input type="number" class="form-control" name="tahun" id="tahun" value="<?= $tahun ?>" placeholder="Tahun Terbit" required>
          </div>
          <div class="form-group">
            <label for="rating">Rating Film</label>
            <input type="text" class="form-control" name="rating" id="rating" value="<?= $rating ?>" placeholder="Rating Film" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"><?= $deskripsi ?></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-primary" title="Simpan data">Simpan</button>
        </form>
      </div>
    </div>
  </main>

  <div class="footer bg-dark text-light py-3 mt-3">
    <div class="container">
      <p class="m-0">Copyright &copy 2022 | Norbertus Tenau (2113201019)</p>
    </div>
  </div>

  <script src="./bootstrap/jquery-3.6.0.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>