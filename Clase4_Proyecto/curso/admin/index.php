<?php
include "header.php";
include "../funciones.php";
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = "panel";
}
cargarPagina($page);

