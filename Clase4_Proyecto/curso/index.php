<?php
include "header.php"; // Solo HTML
include "funciones.php"; // Funciones utilitarias y conexión con db
include "funciones_api.php";
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = "inicio";
}
cargarPagina($page);
include "footer.php";
