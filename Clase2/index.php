<?php

require_once 'class/Peticion.php';

$peticionActual = new Peticion([
    'url' => $_GET['url'],
    'metodo' => $_SERVER['REQUEST_METHOD'],
    'cuerpo' => json_decode(file_get_contents('php://input')),
    'cabeceras' => apache_request_headers()
]);