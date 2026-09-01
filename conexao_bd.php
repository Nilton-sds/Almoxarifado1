<?php
// conexao_bd.php
$host     = "dpg-daa0oogn74is739fpv70-a"; // Se rodar fora do Render, use: dpg-daa0oogn74is739fpv70-a.oregon-postgres.render.com
$db       = "deploy_render_41hh";
$user     = "nilsantos";
$password = "HxEoOGTN0JKIWJB7Nyz3uAw238Fgx0lF";
$port     = "5432";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db;", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
