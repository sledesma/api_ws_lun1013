<?php

class Peticion {

    private $url;
    private $metodo;
    private $cuerpo;
    private $cabeceras;

    public function __construct($config = []) {
        $this->url = $config['url'];
        $this->metodo = $config['metodo'];
        $this->cuerpo = $config['cuerpo'];
        $this->cabeceras = $config['cabeceras'];
    }

    public function url($val = null) {
        if(!is_null($val)) {
            $this->url = $val;
        }
        return $this->url;
    }

    public function metodo($val = null) {
        if(!is_null($val)) {
            $this->metodo = $val;
        }
        return $this->metodo;
    }

    public function cuerpo($val = null) {
        if(!is_null($val)) {
            $this->cuerpo = $val;
        }
        return $this->cuerpo;
    }

    public function cabeceras($val = null) {
        if(!is_null($val)) {
            $this->cabeceras = $val;
        }
        return $this->cabeceras;
    }

}

/*
new Peticion([
    'url' => $_GET['url'],
    'metodo' => $_SERVER['REQUEST_METHOD'],
    'cuerpo' => json_decode(file_get_contents('php://input')),
    'cabeceras' => apache_request_headers()
])
*/