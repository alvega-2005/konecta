<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['producto']) || empty($_POST['precio'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $codproducto = $_GET['id'];
    $categoria = $_POST['categoria'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $query_update = mysqli_query($conexion, "UPDATE productos SET nombre_producto = '$producto', categoria= $categoria,precio= $precio WHERE id_producto = $codproducto");
    if ($query_update) {
      $alert = '<div class="alert alert-primary" role="alert">
              Modificado
            </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                Error al Modificar
              </div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: lista_productos.php");
} else {
  $id_producto = $_REQUEST['id'];
  if (!is_numeric($id_producto)) {
    header("Location: lista_productos.php");
  }
  $query_producto = mysqli_query($conexion, "SELECT p.id_producto, p.descripcion, p.precio, pr.id_categoria, pr.nombre FROM productos p INNER JOIN categorias pr ON p.categoria = pr.id_categoria WHERE p.id_producto = $id_producto");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: lista_productos.php");
  }
}
?>

<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="card">
        <div class="card-header bg-primary text-white">
          Modificar producto
        </div>
        <div class="card-body">
          <form action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
              <label for="nombre">Categoria</label>
              <?php $query_categoria = mysqli_query($conexion, "SELECT * FROM categorias ORDER BY nombre ASC");
              $resultado_categoria = mysqli_num_rows($query_categoria);
              mysqli_close($conexion);
              ?>
              <select id="categoria" name="categoria" class="form-control">
                <option value="<?php echo $data_producto['id_categoria']; ?>" selected><?php echo $data_producto['nombre']; ?></option>
                <?php
                if ($resultado_categoria > 0) {
                  while ($categoria = mysqli_fetch_array($query_categoria)) {
                    // code...
                ?>
                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre']; ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="producto">Producto</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="producto" id="producto" value="<?php echo $data_producto['descripcion']; ?>">

            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio" value="<?php echo $data_producto['precio']; ?>">

            </div>
            <input type="submit" value="Actualizar Producto" class="btn btn-primary">
            <a href="lista_productos.php" class="btn btn-danger">Regresar</a>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>


</div>

<?php include_once "includes/footer.php"; ?>