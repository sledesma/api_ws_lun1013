<div class="container">
	<section id="page">
		<div class="main">
			<div class="reservation_top">
				<div class=" contact_right">
					<h3>Contacto</h3>
					
					<?php
					
					if(isset($_GET['rta'])){
						$rta= $_GET['rta'];
						$mensaje = mostrarMensaje($rta);
						echo $mensaje;
					}
					?>
				
					<div class="contact-form">

						<form action="enviar.php" method="post">
							<input type="text" class="textbox" placeholder="Nombre" name="nombre">
							<input type="text" class="textbox" placeholder="E-Mail" name="email">
							<textarea placeholder="Mensaje" name="mensaje"></textarea>
							<input type="submit" value="Enviar">
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="clearfix"></div>
</div>