<?php
session_start();
include_once("conexao_bd.php");

if (count($_POST) > 0) {
    $email = $_POST["email"] ?? '';
    $senha = $_POST["senha1"] ?? '';

    try {
        $consulta = $conn->prepare("SELECT * FROM usuario WHERE situacao='habilitado' AND email=:email AND senha1=md5(:senha)");
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
        $consulta->execute();

        $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($usuarios) == 1) {
            $_SESSION['usuario_nome'] = $usuarios[0]['email']; // Salva sessão
            header("Location: produto.php");
            exit;
        } else {
            $_SESSION['erro_login'] = "E-mail e senha não conferem";
            header("Location: index.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['erro_login'] = "Erro ao autenticar: " . $e->getMessage();
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
