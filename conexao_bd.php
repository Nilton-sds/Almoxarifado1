<?php
// Configurações da conexão com o Render
$host     = "dpg-daa0oogn74is739fpv70-a"; // Ou a External URL caso a aplicação rode fora do Render
$db       = "deploy_render_41hh";
$user     = "nilsantos"; // <-- Alterado de "admin" para "nilsantos"
$password = "HxEoOGTN0JKIWJB7Nyz3uAw238Fgx0lF";
$port     = "5432";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db;", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erro ao consultar banco de dados: " . $e->getMessage());
}
?>
