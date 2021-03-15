<?php

function apiObtenerMinimo($conexion) {
    // ACA VIENE LA CONEXIÓN CON LA API
    // cURL

    $productos = $conexion->query('SELECT * FROM productos')->fetchAll(PDO::FETCH_ASSOC);

    // 1. Crear la sesión (parecido al fopen)
    $curl = curl_init();
    
    // 2. Configurar la petición (con las variables HTTP)
    curl_setopt($curl, CURLOPT_URL, 'http://localhost/api_ws_lun1013/Clase4_Proyecto/api/minimo/');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($productos));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // 3. Enviar la petición
    $resultado = curl_exec($curl);

    // 4. Cerrar el handler
    curl_close($curl);

    if($resultado !== false) {
        return json_decode($resultado, true);
    } else {
        die('Error al conectarse con la API');
    }

}