<?php
require './config/koneksi.php';
cek_login();
?>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CRUD Data Film</title>
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
          <a class="nav-link active" href="./index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./negara.php">Negara</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./genre.php">Genre</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./film.php">Film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <main class="container my-3">
    <div class="card">
      <h5 class="card-header">CRUD Data Film</h5>
      <div class="card-body">
        <h5 class="card-title">Aplikasi pengelolaan data film</h5>
        <p class="card-text">Aplikasi ini dibuat untuk Ujian akhir semester Mata kuliah pemrograman web I, Dalam aplikasi ini terdapat fitur authentikasi, dan beberapa tabel diantaranya tabel Administrator, Negara, Genre Dan tabel film.</p>
        <p class="card-text">Aplikasi ini dibuat oleh:</p>
        <p class="card-text my-0 py-0">Dila Yuliani</p>
        <p class="card-text my-0 py-0">2113201080</p>
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