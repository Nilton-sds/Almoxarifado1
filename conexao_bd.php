<?php
$servername = "dpg-daa0oogn74is739fpv70-a"; 
$port       = "5432";
$dbname     = "deploy_render_41hh";
$username   = "admin";
$password   = "9mmlcGMT6io2fCrnnYhBRehQ08evPvu0";

try {
    // Altera de mysql: para pgsql:
    $conn = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro ao consultar banco de dados: " . $e->getMessage();
}
?>
