<?php

require_once 'class/Peticion.php';
require_once 'class/Respuesta.php';
require_once 'class/Router.php';

$peticionActual = new Peticion([
    'url' => $_GET['url'],
    'metodo' => $_SERVER['REQUEST_METHOD'],
    'cuerpo' => json_decode(file_get_contents('php://input')),
    'cabeceras' => apache_request_headers()
]);

$router = new Router(); 

$router->get('#productos[/\d]*#', function($peticion, $respuesta){
    // ['productos', '1']
    $urlParts = explode('/', $peticion->url());
    $id = $urlParts[1];

    try {
        
        $pdo = new PDO('mysql:host=localhost;dbname=caso_api2', 'root', '');

        $data = $pdo
                    ->query('SELECT * FROM productos WHERE Id = '.$id)
                    ->fetch(PDO::FETCH_ASSOC);

        $respuesta->status(200)->json($data);

    } catch(Exception $ex) {

        $respuesta->status(500)->json([
            'msj' => 'Error al conectarse con la base de datos'
        ]);

    }
});


// Listar todos los productos
$router->get('#productos#', function($peticion, $respuesta){

    // PUEDE VENIR CUALQUIER CODIGO
    try {
        
        $pdo = new PDO('mysql:host=localhost;dbname=caso_api2', 'root', '');

        $data = $pdo->query('SELECT * FROM productos')->fetchAll(PDO::FETCH_ASSOC);

        $respuesta->status(200)->json($data);

    } catch(Exception $ex) {

        $respuesta->status(500)->json([
            'msj' => 'Error al conectarse con la base de datos'
        ]);

    }
});


$router->procesarPeticion($peticionActual);
