<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'peliculas'
) or die(mysqli_error($mysqli));

?>
