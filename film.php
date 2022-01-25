<?php
require './config/koneksi.php';
cek_login();

// deklarasi variable pesan
$message = false;
$message_status = false;
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $result = mysqli_query($conn, "DELETE FROM film WHERE id = '$id'");
  // buat pesan untuk menandakan query berhasil atau tidak
  $message = $result ? "Data berhasil dihapus" : "Data gagal dihapus";
  $message_status = $result;
}
?>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Film | CRUD Data Film</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- bootstrap template -->

  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
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
          <a class="nav-link" href="./negara.php">Negara</a>
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
          <label class="h6">Data Film</label>
          <a href="./film-form.php" class="btn btn-sm btn-info">Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-responsive-md table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Negara</th>
              <th scope="col">Genre</th>
              <th scope="col">Tahun</th>
              <th scope="col">Rating</th>
              <th scope="col">Deskripsi</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT
                          bu.*, pt.nama as genre, ps.nama as negara
                      FROM
                          film AS bu
                      Left JOIN genre AS pt
                      ON
                          bu.genre_id = pt.id
                      Left JOIN negara AS ps
                      ON
                          bu.negara_id = ps.id
            ";

            $result = mysqli_query($conn, $query);
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {
              $counter++;
              $row = (object)$row;

              $btn_edit =  '<a href="./film-form.php?edit=' . $row->id . '" class="btn btn-sm btn-primary">Edit</a>';
              $btn_delete =  '<a href="./film.php?delete=' . $row->id . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-sm btn-danger">Hapus</a>';
              echo "<tr>
              <th>$counter</th>
              <td>{$row->nama}</td>
              <td>{$row->negara}</td>
              <td>{$row->genre}</td>
              <td>{$row->tahun}</td>
              <td>{$row->rating}</td>
              <td>{$row->deskripsi}</td>
              <td>$btn_edit  $btn_delete</td>
            </tr>";
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </main>

  <div class="footer bg-info text-light py-3 mt-3">
    <div class="container">
      <p class="m-0">Copyright &copy 2022 | Dila Yuliani (2113201080)</p>
    </div>
  </div>

  <script src="./bootstrap/jquery-3.6.0.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>