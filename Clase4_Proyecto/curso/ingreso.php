<?php
if (isset($_POST['enviar'])) {
	$email = $_POST['email'];
	$clave = $_POST['clave'];
	accederAdmin($email, $clave);
}
if(isset($_GET['rta'])){
	$rta=$_GET['rta'];
	echo mostrarMensaje($rta);
}
if(isset($_GET['salir'])){
	session_start();
	unset($_SESSION);//borrar las variables de session
	session_destroy();
	setcookie(session_name(),null);
	header("location:./?alerta=true");
}
?>
<div class="container">
	<section id="page">
		<div class="account_grid">
			<div class="login-right">
				<h3>INGRESO DE USUARIO</h3>
				<form action="#" method="post">
					<div>
						<span>E-Mail:</span>
						<input type="text" name="email">
					</div>
					<div>
						<span>Contraseña:</span>
						<input type="password" name="clave">
					</div>
					<input type="submit" value="Ingresar" name="enviar">
					<br>
					<a class="forgot" href="#">¿Olvidaste tu contraseña?</a>
				</form>
			</div>
			<div class=" login-left">
				<h3>¿NUEVO USUARIO?</h3>
				<a class="acount-btn" href="registro.php">Crear una cuenta</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>
	<div class="clearfix"></div>
</div>