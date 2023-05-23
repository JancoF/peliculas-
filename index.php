<?php include("db.php"); ?>

<?php include("Componentes/header.php"); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- FORMULARIO -->
      <div class="card card-body">
        <form action="save.php" method="POST" enctype="multipart/form-data">
          <div class="form-floating mb-3">
            <input type="text" name="titulo" class="form-control" placeholder="Titulo pelicula" autofocus>
            <label for="floatingInput">Titulo</label>
          </div>
          <div class="orm-floating mb-3">
            <textarea name="descripcion" rows="2" class="form-control" placeholder="Descripcion"></textarea>
          </div>
          <div class="form-floating mb-3">
            <input name="genero" rows="2" class="form-control" placeholder="Tipo Genero"></input>
            <label for="floatingInput">Genero</label>
          </div>
          <div class="mb-3">
            <label for="formFileSm" class="form-label">Subir Poster</label>
            <input class="form-control form-control-sm"  type="file" name="poster">
          </div>
          <input type="submit" name="save" class="mx-auto btn btn-primary" value="REGISTRAR">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>genero</th>
            <th>poster</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM pelicula";
          $result_movies = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_movies)) { ?>
          <tr>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['descripcion']; ?></td>
            <td><?php echo $row['genero']; ?></td>
            <td><img  src="/posters/mrrobot.jpg" alt="<?php echo $row['poster_name']; ?>"></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
              <a href="whatsapp.php?id=<?php echo $row['id']?>" class="btn btn-success">
                <i class="fa fa-whatsapp"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php //include('includes/footer.php'); ?> 
