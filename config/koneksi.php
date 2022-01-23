<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "almardiy_j_film";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
function cek_login()
{
  $result = isset($_SESSION['login']) ? $_SESSION['login'] : false;
  if (!$result) {
    header("Location: login.php");
    exit;
  }
  return $result;
}
