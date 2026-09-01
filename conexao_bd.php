<?php
// 1. Apague quaisquer variáveis locais ($servername, $username, $password) deste arquivo.

if(count($_POST) > 0) {
    $email = $_POST["email"];
    $senha = $_POST["senha1"];

    try {
        // 2. O include do arquivo com o usuário 'nilsantos' deve vir ANTES de usar a variável $conn
        include("conexao_bd.php");

        // Prepare a consulta no PostgreSQL
        $consulta = $conn->prepare("SELECT * FROM usuario WHERE situacao='habilitado' AND email=:email AND senha1=md5(:senha)");
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);

        $consulta->execute();
        $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($usuarios) == 1) {
            $resultado['msg'] = "Usuário encontrado";
            $resultado['cod'] = 1;
            $resultado['style'] = "alert-success";
            header("Location: produto.php");
            exit;
        } else {
            $resultado['msg'] = "E-mail e senha não conferem";
            $resultado['cod'] = 0;
            $resultado['style'] = "alert-danger";
        }
    } catch(PDOException $e) {
        $resultado['msg'] = "Erro ao autenticar usuário: " . $e->getMessage();
        $resultado['cod'] = 0;
        $resultado['style'] = "alert-danger";
    }

    $conn = null;
}
?>
