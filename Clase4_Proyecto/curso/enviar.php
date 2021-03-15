<?php
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$mensaje = trim($_POST['mensaje']);
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
if (empty($nombre)) {
    header("location:./?page=contacto&rta=0X001");
} elseif (strlen($nombre) < 3) {
    header("location:./?page=contacto&rta=0X001");
} elseif (is_numeric($nombre)) {
    header("location:./?page=contacto&rta=0X001");
} elseif (is_numeric(substr($nombre, 0, 1))) {
    header("location:./?page=contacto&rta=0X001");
} elseif (is_numeric(substr($nombre, 0, 1)) || is_numeric(substr($nombre, -1, 1))) {
    header("location:./?page=contacto&rta=0X001");
} elseif (!preg_match($patron_texto, $nombre)) {
    header("location:./?page=contacto&rta=0X001");
} elseif (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    header("location:./?page=contacto&rta=0X002");
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    header("location:./?page=contacto&rta=0X002");
} elseif (strlen($mensaje) > 400) {
    header("location:./?page=contacto&rta=0X003");
} else {
    
    $para = "austry.castillo@educacionit.com";
    $asunto ="Contacto web desde ComerioIt";
    $cuerpo ="<h1 style=color:pink>Contacto web ComerciIt</h1>";
    $cuerpo.="<img src=https://es.freelogodesign.org/Content/img/logo-samples/flooop.png><br><br>";
    $cuerpo.="Nombre: ".$nombre;
    $cuerpo.="<br>Email: ".$email;
    $cuerpo.="<br>Mensaje: ".$mensaje;
    $cuerpo.="<br><br>Chaitoooooooo";
    $cabecera = "From:" . $email . "\r\n";
	$cabecera.= "MIME-Version: 1.0\r\n";
	$cabecera.= "Content-Type: text/html; charset=UTF-8\r\n";
    if(!mail($para,$asunto,$cuerpo,$cabecera)){
        header("location:./?page=contacto&rta=0X005");
    }else{
        header("location:./?page=contacto&rta=0X004");
    }
}
