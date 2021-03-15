<?php

/**
 * Ciclo de vida de una petición HTTP:
 * 
 * 1. Recibe la petición el index a través del .htaccess
 * 2. Definir configuración global
 * 3. Incluimos funciones necesarias
 * 4. Obtenemos el método y la URL de dicha petición
 * 5. Ejecutamos la función asociada
**/

define('BASE_PATH', '/api_ws_lun1013/Clase4_Proyecto/api/');

require_once 'funciones.php';

$request = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI']
];

/**
 * POST /maximo
 */
handleRequest($request, BASE_PATH.'maximo/', 'POST', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    $maximo = [ 'Precio' => -1];
    foreach ($data as $producto) {
        if($producto['Precio'] > $maximo['Precio']) {
            $maximo = $producto;
        }
    }

    echo json_encode($minimo);
});

/**
 * POST /minimo
 */
handleRequest($request, BASE_PATH.'minimo/', 'POST', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    $minimo = [ 'Precio' => 99999999 ];
    foreach ($data as $producto) {
        if($producto['Precio'] < $minimo['Precio']) {
            $minimo = $producto;
        }
    }

    echo json_encode($minimo);
});

/*
array(12) { [0]=> array(9) { ["idProducto"]=> string(1) "5" ["Nombre"]=> string(6) "Moto G" ["Precio"]=> string(6) "489.99" ["Marca"]=> string(1) "5" ["Categoria"]=> string(1) "2" ["Presentacion"]=> string(3) "8GB" ["Stock"]=> string(3) "750" ["Imagen"]=> string(8) "P004.jpg" ["Estado"]=> string(1) "1" } [1]=> array(9) { ["idProducto"]=> string(2) "10" ["Nombre"]=> string(12) "producto BBB" ["Precio"]=> string(2) "20" ["Marca"]=> string(2) "13" ["Categoria"]=> string(1) "1" ["Presentacion"]=> string(4) "20GB" ["Stock"]=> string(2) "20" ["Imagen"]=> string(8) "P005.jpg" ["Estado"]=> string(1) "1" } [2]=> array(9) { ["idProducto"]=> string(2) "24" ["Nombre"]=> string(8) "iPhone 2" ["Precio"]=> string(3) "499" ["Marca"]=> string(1) "1" ["Categoria"]=> string(1) "2" ["Presentacion"]=> string(4) "16GB" ["Stock"]=> string(3) "500" ["Imagen"]=> string(8) "P001.jpg" ["Estado"]=> string(1) "1" } [3]=> array(9) { ["idProducto"]=> string(2) "25" ["Nombre"]=> string(4) "iPad" ["Precio"]=> string(3) "600" ["Marca"]=> string(1) "1" ["Categoria"]=> string(1) "3" ["Presentacion"]=> string(4) "32GB" ["Stock"]=> string(3) "300" ["Imagen"]=> string(8) "P002.jpg" ["Estado"]=> string(1) "1" } [4]=> array(9) { ["idProducto"]=> string(2) "26" ["Nombre"]=> string(5) "Nexus" ["Precio"]=> string(3) "300" ["Marca"]=> string(1) "6" ["Categoria"]=> string(1) "2" ["Presentacion"]=> string(4) "32GB" ["Stock"]=> string(3) "300" ["Imagen"]=> string(8) "P003.jpg" ["Estado"]=> string(1) "1" } [5]=> array(9) { ["idProducto"]=> string(2) "28" ["Nombre"]=> string(9) "Galaxy S7" ["Precio"]=> string(3) "500" ["Marca"]=> string(1) "2" ["Categoria"]=> string(1) "2" ["Presentacion"]=> string(4) "64GB" ["Stock"]=> string(3) "650" ["Imagen"]=> string(8) "P004.jpg" ["Estado"]=> string(1) "1" } [6]=> array(9) { ["idProducto"]=> string(2) "29" ["Nombre"]=> string(6) "Moto G" ["Precio"]=> string(3) "500" ["Marca"]=> string(1) "5" ["Categoria"]=> string(1) "2" ["Presentacion"]=> string(3) "8GB" ["Stock"]=> string(3) "850" ["Imagen"]=> string(8) "P005.jpg" ["Estado"]=> string(1) "1" } [7]=> array(9) { ["idProducto"]=> string(2) "30" ["Nombre"]=> string(6) "LG L40" ["Precio"]=> string(3) "200" ["Marca"]=> string(1) "4" ["Categoria"]=> string(1) "4" ["Presentacion"]=> string(4) "24GB" ["Stock"]=> string(3) "350" ["Imagen"]=> string(8) "P007.jpg" ["Estado"]=> string(1) "1" } [8]=> array(9) { ["idProducto"]=> string(2) "32" ["Nombre"]=> string(14) "producto nuevo" ["Precio"]=> string(3) "100" ["Marca"]=> string(1) "9" ["Categoria"]=> string(1) "4" ["Presentacion"]=> string(4) "24GB" ["Stock"]=> string(3) "500" ["Imagen"]=> string(20) "New Project (25).png" ["Estado"]=> string(1) "1" } [9]=> array(9) { ["idProducto"]=> string(2) "33" ["Nombre"]=> string(9) "pruebista" ["Precio"]=> string(3) "100" ["Marca"]=> string(1) "1" ["Categoria"]=> string(1) "1" ["Presentacion"]=> string(2) "12" ["Stock"]=> string(3) "100" ["Imagen"]=> string(11) "Captura.JPG" ["Estado"]=> string(1) "1" } [10]=> array(9) { ["idProducto"]=> string(2) "34" ["Nombre"]=> string(8) "pruebita" ["Precio"]=> string(3) "100" ["Marca"]=> string(1) "1" ["Categoria"]=> string(1) "1" ["Presentacion"]=> string(4) "24GB" ["Stock"]=> string(3) "100" ["Imagen"]=> string(11) "Captura.JPG" ["Estado"]=> string(1) "1" } [11]=> array(9) { ["idProducto"]=> string(2) "35" ["Nombre"]=> string(8) "pruebita" ["Precio"]=> string(3) "100" ["Marca"]=> string(1) "1" ["Categoria"]=> string(1) "1" ["Presentacion"]=> string(1) "1" ["Stock"]=> string(3) "100" ["Imagen"]=> string(11) "Captura.JPG" ["Estado"]=> string(1) "1" } }
*/