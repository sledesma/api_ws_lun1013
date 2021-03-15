
		<!---->
		<div class="container">
			<section id="page">
					<div class="register">
		<div class="register-top-grid">
			<h3>NUEVO USUARIO</h3>
			<?php
			if(isset($_POST['enviar'])){
				$nombre=$_POST['nombre'];
				$apellido=$_POST['apellido'];
				$email=$_POST['email'];
				$clave=$_POST['clave'];
				$rta= registrarUsuario($nombre,$apellido,$email,$clave);
				echo mostrarMensaje($rta);
			}
			?>
			<form action="#" method="post">
				<div class="mation">
					<span>Nombre: <label>*</label></span>
					<input type="text" name="nombre"> 
					<span>Apellido: <label>*</label></span>
					<input type="text" name="apellido"> 
					<span>E-Mail: <label>*</label></span>
					<input type="text" name="email">
					<span>Contraseña: <label>*</label></span>
					<input type="password" name="clave">
					<div class="register-but">
						<input type="submit" value="Registrarme" name="enviar">
					</div>
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
	</div>

			</section>
			<div class="clearfix"></div>
		</div>

		<!---->
		