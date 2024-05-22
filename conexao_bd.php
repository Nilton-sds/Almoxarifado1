<?php


 
$servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$consulta = $conn->prepare("SELECT codigo FROM usuario Where email=:email AND senha1=md5 (:senha)");





?>