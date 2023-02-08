<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $codproducto = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM productos WHERE id_producto = $codproducto");
    mysqli_close($conexion);
    header("location: lista_productos.php");
}
?>