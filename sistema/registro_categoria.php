<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                        Todo los campos son obligatorios
                    </div>';
    } else {
        $nombre = $_POST['nombre'];
        $usuario_id = $_SESSION['idUser'];
        $query = mysqli_query($conexion, "SELECT * FROM categorias where nombre = '$nombre'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El categoria ya esta registrada
                    </div>';
        }else{
        

        $query_insert = mysqli_query($conexion, "INSERT INTO categorias(nombre,usuario_id) values ('$nombre', '$usuario_id')");
        if ($query_insert) {
            $alert = '<div class="alert alert-primary" role="alert">
                        Categoria Registrada
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                       Error al registrar categoria
                    </div>';
        }
        }
    }
}
mysqli_close($conexion);
?>


<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                Registro de Categoria
            </div>
            <div class="card">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" placeholder="Ingrese nombre" name="nombre" id="nombre" class="form-control">
                    </div>
                    
                    <input type="submit" value="Guardar categoria" class="btn btn-primary">
                    <a href="lista_categorias.php" class="btn btn-danger">Regresar</a>
                </form>
            </div>
        </div>
    </div>


</div>


</div>

<?php include_once "includes/footer.php"; ?>