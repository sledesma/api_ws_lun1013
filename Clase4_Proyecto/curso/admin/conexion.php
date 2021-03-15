<?php
//localhost
$host='localhost';
$user='root';
$pass='';
$database='comercioitmj';
//hosting
// $host='localhost';
// $user='ilfmdykm_sistem';
// $pass='.2{ws@Eva7Km';
// $database='ilfmdykm_comercioitmj';
try{
    $conexion = new PDO("mysql:host=$host;dbname=$database",$user,$pass);
    echo "Me conecto";
}catch(PDOException $e){
    print 'Error no conecto'.$e->getMessage();
}
