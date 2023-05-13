<?php
include("db.php");
$title = '';
$description= '';
$genero = '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM pelicula WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['titulo'];
    $description = $row['descripcion'];
    $genero = $row['genero'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $title= $_POST['titulo'];
  $description = $_POST['descripcion'];
  $genero= $_POST['genero'];

  $query = "UPDATE pelicula set titulo = '$title', descripcion = '$description', genero = '$genero' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Se Actualizo correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('Componentes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="titulo" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Titulo Pelicula">
        </div>
        <div class="form-group">
        <textarea name="descripcion" class="form-control" cols="30" rows="10"><?php echo $description;?></textarea>
        </div>
        <div class="form-group">
          <input name="genero" type="text" class="form-control" value="<?php echo $genero; ?>" placeholder="Actualizar Pelicula">
        </div>
        <button class="btn-success" name="update">
          Actualizar Pelicula
        </button>
      </form>
      </div>
    </div>
  </div>
</div>

