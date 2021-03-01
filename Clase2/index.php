<?php

require_once 'class/Peticion.php';
require_once 'class/Respuesta.php';

$peticionActual = new Peticion([
    'url' => $_GET['url'],
    'metodo' => $_SERVER['REQUEST_METHOD'],
    'cuerpo' => json_decode(file_get_contents('php://input')),
    'cabeceras' => apache_request_headers()
]);

$respuesta = new Respuesta();

$respuesta->status(400);
$respuesta->json([
    'mensaje' => 'Filtro erroneo flaco'
]);