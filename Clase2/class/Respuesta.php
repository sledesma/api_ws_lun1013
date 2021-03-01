<?php

class Respuesta {

    public function json($data) {
        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function status($code) {
        http_response_code($code);
        return $this;
    }

}