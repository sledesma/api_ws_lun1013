<?php

// HTTP
// ¿Qué hace el SERVIDOR HTTP?
// 1) Recibe una petición HTTP
$peticionRest = [
    'url' => $_GET['url'],
    'metodo' => $_SERVER['REQUEST_METHOD'],
    'cuerpo' => json_decode(file_get_contents('php://input')),
    'cabeceras' => apache_request_headers()
];

$peticionXML = [
    'url' => $_GET['url'],
    'metodo' => $_SERVER['REQUEST_METHOD'],
    'cuerpo' => simplexml_load_string(file_get_contents('php://input')),
    'cabeceras' => apache_request_headers()
];

// 2) Devuelve una respuesta HTTP
function respuestaRest($data) {
    header('Content-type: application/json');
    echo json_encode($data);
}

function respuestaXML($data) {
    header('Content-type: text/xml');
    echo $data;
}


/*
Repaso de método y cabecera

*/

// prfsebastianledesma@gmail.com

