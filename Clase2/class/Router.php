<?php

/**
 * El Router es el centro de la resolución
 * de los REQUERIMIENTOS FUNCIONALES
 * de una API
 */
class Router {

    private $mapPeticionRespuesta = [];

    // Sub
    private function agregarParPeticionRespuesta($peticion, $respuesta) {
        array_push($this->mapPeticionRespuesta, [
            'peticion' => $peticion,
            'respuesta' => $respuesta
        ]);
    }

    public function get($url, $respuesta) { 
        $this->agregarParPeticionRespuesta([
            'url' => $url,
            'metodo' => 'GET'
        ], $respuesta); 
    }

    // Pub
    public function procesarPeticion($peticion) {
        foreach($this->mapPeticionRespuesta as $equivalencia) {
            if(preg_match($equivalencia['peticion']['url'], $peticion->url())
                && $equivalencia['peticion']['metodo'] == $peticion->metodo()) {
                    // Enviar una respuesta
                    $equivalencia['respuesta'](
                        $peticion,
                        new Respuesta()
                    );
                }
        }
    }

}