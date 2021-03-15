<?php

function handleRequest($request, $url, $method, $callback) {
    if($request['uri'] == $url && $request['method'] == $method) {
        $callback();
    }
}