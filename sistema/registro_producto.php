 <?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['categoria']) || empty($_POST['referencia']) || empty($_POST['fecha'])|| empty($_POST['descripcion']) || empty($_POST['precio']) || $_POST['precio'] <  0 || empty($_POST['peso']) || $_POST['peso'] <  0 || empty($_POST['existencia'] || $_POST['existencia'] <  0)) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $categoria = $_POST['categoria'];
      $nombre_producto = $_POST['descripcion'];
      $referencia = $_POST['referencia'];
      $fecha = $_POST['fecha'];
      $precio = $_POST['precio'];
      $peso = $_POST['peso'];
      $stock = $_POST['existencia'];
      $usuario_id = $_SESSION['idUser'];

      $query_insert = mysqli_query($conexion, "INSERT INTO productos(descripcion,referencia,precio,peso,categoria,existencia, fecha_creacion,usuario_id) values ('$nombre_producto', '$referencia', '$precio', '$peso','$categoria','$stock', '$fecha','$usuario_id')");
      if ($query_insert) {
        $alert = '<div class="alert alert-primary" role="alert">
                Producto Registrado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
      }
    }
  }
  ?>

 
 <div class="container-fluid">

   
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
     <a href="lista_productos.php" class="btn btn-primary">Regresar</a>
   </div>

   
   <div class="row">
     <div class="col-lg-6 m-auto">
       <form action="" method="post" autocomplete="off">
         <?php echo isset($alert) ? $alert : ''; ?>
         <div class="form-group">
           <label>Categoria</label>
           <?php
            $query_categoria = mysqli_query($conexion, "SELECT id_categoria, nombre FROM categorias ORDER BY nombre ASC");
            $resultado_categoria = mysqli_num_rows($query_categoria);
            mysqli_close($conexion);
            ?>
           <select id="categoria" name="categoria" class="form-control">
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
           <label for="descripcion">Producto</label>
           <input type="text" placeholder="Ingrese nombre del producto" name="descripcion" id="descripcion" class="form-control">
         </div>
         <div class="form-group">
           <label for="referencia">Referencia</label>
           <input type="text" placeholder="Ingrese la referencia" name="referencia" id="referencia" class="form-control">
         </div>
         <div class="form-group">
           <label for="precio">Precio</label>
           <input type="number" placeholder="Ingrese precio" class="form-control" name="precio" id="precio">
         </div>
         <div class="form-group">
           <label for="peso">Peso</label>
           <input type="number" placeholder="Ingrese el peso" class="form-control" name="peso" id="peso">
         </div>
         <div class="form-group">
           <label for="existencia">Cantidad</label>
           <input type="number" placeholder="Ingrese Stock" class="form-control" name="existencia" id="existencia">
         </div>

         <div class="form-group">
           <label for="fecha">Fecha de Ingreso</label>
           <input type="date" class="form-control" name="fecha" id="fecha">
         </div>
         <input type="submit" value="Guardar Producto" class="btn btn-primary">
       </form>
     </div>
   </div>


 </div>
 

 </div>
 
 <?php include_once "includes/footer.php"; ?>