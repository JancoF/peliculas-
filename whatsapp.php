<?php
include("db.php");

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']); // Escapar el ID para evitar inyecciones de SQL
  $query = "SELECT * FROM pelicula WHERE id=$id";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['titulo'];
    $description = $row['descripcion'];
    $genero = $row['genero'];
    $archivo = $row['poster_name'];

    $curl = curl_init();
  
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.green-api.com/waInstance1101818658/sendFileByUpload/f0cc4c4088f54a618d53784be258537aa54220b120a8425393",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => array(
          'chatId' => "51".'980814284',"@c.us",
          'chatId' => "51".'926918999',"@c.us",
          'caption' => 'PELICULA: '.strtoupper($title).' DESCRIPCION: '.strtoupper($description).' GENERO: '.strtoupper($genero),
          'file' => curl_file_create('posters/'.$archivo, 'image/jpeg', $archivo)
      ),
      CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: multipart/form-data"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "CURL Error #:" . $err;
    } else {
      echo $response;
    }
  } else {
    echo "No se encontró ninguna película con ese ID";
  }
} else {
  echo "El ID de la película no está definido";
}
?>
