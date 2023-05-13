<?php
include('db.php');

if (isset($_POST['save'])) {
  $title = $_POST['titulo'];
  $description = $_POST['descripcion'];
  $genero = $_POST['genero'];

  // Verificar si se ha cargado un archivo y si no hay errores
  if(isset($_FILES["poster"]) && $_FILES["poster"]["error"] == 0) {
    $archivo = $_FILES["poster"]["name"];
    $ruta_temporal = $_FILES["poster"]["tmp_name"];
    $ruta_destino = "posters/" . $archivo;

    // Verificar si el directorio de destino existe, si no, crearlo
    if(!file_exists("posters")) {
      mkdir("posters");
    }

    // Mover el archivo a la ruta de destino
    if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
      chmod('postets/', 0755); // asignar permisos de lectura y escritura
      $query = "INSERT INTO pelicula(titulo, descripcion, genero, poster_name) VALUES ('$title', '$description','$genero', '$archivo')";
      $result = mysqli_query($conn, $query);
      if(!$result) {
        die("Fallo consulta.");
      }
      $_SESSION['message'] = '<div class="alert alert-success" role="alert">Se guardó exitosamente.</div>';
      $_SESSION['message_type'] = 'realizado';
      header('Location: index.php');
    } else {
      echo "Ha ocurrido un error al cargar el archivo.";
    }
  } else {
    echo "Debe seleccionar un archivo para cargar.";
  }

}

?>

