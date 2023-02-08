<?php include_once "includes/header.php"; ?>


<div class="container-fluid">

	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Productos</h1>
		<a href="registro_producto.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>PRODUCTO</th>
							<th>CATEGORIA</th>
							<th>STOCK</th>
							<th>PRECIO</th>
							
							<?php if ($_SESSION['rol'] == 1) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT * FROM productos");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['id_producto']; ?></td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><?php echo $data['categoria']; ?></td>
									

									<td><?php echo $data['existencia']; ?></td>
									<td><?php echo $data['precio']; ?></td>
										<?php if ($_SESSION['rol'] == 1) { ?>
									<td>
										<a href="agregar_producto.php?id=<?php echo $data['id_producto']; ?>" class="btn btn-primary"><i class='fas fa-audio-description'></i></a>

										<a href="editar_producto.php?id=<?php echo $data['id_producto']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

										<form action="eliminar_producto.php?id=<?php echo $data['id_producto']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td>
										<?php } ?>
								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>

</div>


</div>



<?php include_once "includes/footer.php"; ?>