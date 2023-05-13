<?php

include("db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM pelicula WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Fallo consulta.");
  }

  $_SESSION['message'] = 'Se elimino correctamente';
  $_SESSION['message_type'] = 'Peligro';
  header('Location: index.php');
}

?>
