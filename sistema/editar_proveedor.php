<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) ) {
    $alert = '<p class"msg_error">Todo los campos son requeridos</p>';
  } else {
    $idcategoria = $_GET['id'];
    $nombre = $_POST['nombre'];
    

    $sql_update = mysqli_query($conexion, "UPDATE categorias SET nombre = '$nombre' WHERE id_categoria = $idcategoria");

    if ($sql_update) {
      $alert = '<p class"msg_save">Categoria Actualizada correctamente</p>';
    } else {
      $alert = '<p class"msg_error">Error al Actualizar la categoria</p>';
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_categorias.php");
  mysqli_close($conexion);
}
$idcategoria = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM categorias WHERE id_categoria = $idcategoria");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_categorias.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idcategoria = $data['id_categoria'];
    $nomcategoria = $data['nombre'];
    
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <?php echo isset($alert) ? $alert : ''; ?>
      <form class="" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $idcategoria; ?>">
        <div class="form-group">
          <label for="nombre">Categoria</label>
          <input type="text" placeholder="Ingrese categoria" name="nombre" class="form-control" id="nombre" value="<?php echo $nomcategoria; ?>">
        </div>
        

        <input type="submit" value="Editar Categoria" class="btn btn-primary">
        <a href="lista_categorias.php" class="btn btn-danger">Regresar</a>
      </form>
      
    </div>
  </div>


</div>


</div>

<?php include_once "includes/footer.php"; ?>