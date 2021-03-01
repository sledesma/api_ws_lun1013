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

// REQUERIMIENTOS FUNCIONALES
$equivalenciasPeticionRespuesta = 
[
    [
        'peticion' => [
            'url' => 'productos',
            'metodo' => 'GET'
        ],
        'respuesta' => [
            'codigoEstado' => 200,
            'datos' => [
                'mensaje' => 'Hola mundo desde productos'
            ]
        ]
    ]
];

function procesarPeticion($peticion) {
    foreach($equivalenciasPeticionRespuesta as $equivalencia) {
        if($equivalencia['peticion']['url'] == $peticion->url() 
            && $equivalencia['peticion']['metodo'] == $peticion->metodo()) {
                $respuesta->status($equivalencia['respuesta']['codigoEstado']);
                $respuesta->json($equivalencia['respuesta']['datos']);
            }
    }
}

procesarPeticion($peticionActual);


// Una API es un conjunto de equivalencias Petición / Respuesta

