<?php
if (isset($_GET['alerta'])) {
?>
	<script>
		alert('Sessión cerrada correctamente adiosssss');
	</script>
<?php
}
?>
<div class="container">
	<section id="page">
		<!-- PRODUCTOS DESTACADOS -->
		<form action="" method="get">
			<input type="text" name="dato">

			<select name="filtro">
				<option value="b">más barato</option>
				<option value="c">más caro</option>
			</select>
			<input type="submit" value="buscar" name="buscar">
		</form>
		<div class="shoes-grid">
			<div class="products">
				<h5 class="latest-product">PRODUCTOS DESTACADOS</h5>

			</div>
			<?php
			include 'admin/conexion.php';
			if (isset($_GET['buscar'])) {
				$dato = $_GET['dato'];
				$filtro = ($_GET['filtro'] == 'b') ? 'asc' : 'desc';
				$sql = "SELECT * FROM productos where Estado=1 and Nombre like '%$dato%' ORDER BY Precio $filtro";
			} else {

				$p = (isset($_GET['p'])) ? $_GET['p'] : 0;
				$cp = 2;
				$offset = $p > 0 ? $p * $cp : NULL;
				if ($offset > 0) {
					$sql = "SELECT * FROM productos where Estado=1 limit " . $cp . " offset " . $offset;
				} else {
					$sql = "SELECT * FROM productos where Estado=1 limit " . $cp;
				}
			}
			$conexion->prepare($sql);
			$contador = 1;
			foreach ($conexion->query($sql) as $row) {
			?>
				<div class="product-left">
					<!-- Producto #1 -->
					<div class="col-sm-4 col-md-4 chain-grid <?php if ($contador % 3 == 0) echo 'grid-top-chain'; ?>">
						<a href="./?page=producto&idProducto=<?= $row['idProducto']; ?>"><img class="img-responsive chain" src="images/productos/<?= $row['Imagen']; ?>" alt=" " /></a>
						<div class="grid-chain-bottom">
							<h6><a href="producto.php"><?= $row['Nombre']; ?></a></h6>
							<div class="star-price">
								<div class="dolor-grid">
									<span class="actual">$<?= $row['Precio']; ?></span>
								</div>
								<a class="now-get get-cart" href="./?page=producto&idProducto=<?= $row['idProducto']; ?>">VER MÁS</a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				<?php
				$contador++;
			}
				?>

				<div class="clearfix"></div>
				</div>
				<div class="clearfix"> </div>
		</div>
		<div class="products">
			<?php
			$sql = "SELECT count(*) from productos";
			$result = $conexion->prepare($sql);
			$result->execute();
			$total = $result->fetch(PDO::FETCH_COLUMN);
			$tp = $total / $cp;
			if ($p > 0) {
				echo "<a href=./?page=inicio&p=" . ($p - 1) . "> Anterior</a> ";
			}
			for ($i = 0; $i < $tp; $i++) {
				echo "<a href=./?page=inicio&p=" . $i . ">" . ($i + 1) . "</a> ";
			}
			if($p < $tp -1){
				echo " <a href=./?page=inicio&p=" . ($p + 1) . "> Siguiente</a> ";
			}
			?>
		</div>

		<!-- CONEXION A API: PRODUCTO MENOR PRECIO -->
		<?php $min = apiObtenerMinimo($conexion) ?>
		<div class="shoes-grid">
			<div class="products">
				<h5 class="latest-product">PRODUCTO MAS BARATO</h5>
			</div>
			<div class="col-sm-4 col-md-4 chain-grid grid-top-chain">
						<a href="./?page=producto&idProducto=<?= $min['idProducto']; ?>"><img class="img-responsive chain" src="images/productos/<?= $row['Imagen']; ?>" alt=" " /></a>
						<div class="grid-chain-bottom">
							<h6><a href="producto.php"><?= $min['Nombre']; ?></a></h6>
							<div class="star-price">
								<div class="dolor-grid">
									<span class="actual">$<?= $min['Precio']; ?></span>
								</div>
								<a class="now-get get-cart" href="./?page=producto&idProducto=<?= $min['idProducto']; ?>">VER MÁS</a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
		</div>
		<?php unset($min); ?>
		<!-- FIN CONEXION A API: PRODUCTO MENOR PRECIO -->

		<!-- ULTIMOS PRODUCTOS -->
		<div class="shoes-grid">
			<div class="products">
				<h5 class="latest-product">ULTIMOS PRODUCTOS</h5>
				<a class="view-all" href="./?page=productos">VER TODOS<span></span></a>
			</div>
			<div class="product-left">

				<div class="clearfix"></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</section>
</div>