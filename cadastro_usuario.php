<?php

$resultado = array(); // Inicialize o array $resultado para evitar erros de variável indefinida

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : null;
    $email = isset($_POST["email_usuario"]) ? trim($_POST["email_usuario"]) : null;
    $senha1 = isset($_POST["senha1"]) ? trim($_POST["senha1"]) : null;
    $senha2 = isset($_POST["senha2"]) ? trim($_POST["senha2"]) : null;

    // Verificar se os campos estão preenchidos
    if (empty($nome) || empty($email) || empty($senha1) || empty($senha2)) {
        $resultado["msg"] = "Por favor, preencha todos os campos do formulário.";
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    } else {
        try {
            include("conexao_bd.php");

            // Verificar se o email já está em uso
            $verificarEmail = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
            $verificarEmail->execute([$email]);

            if ($verificarEmail->rowCount() > 0) {
                // Email já em uso
                $resultado["msg"] = "Email já cadastrado. Por favor, escolha outro.";
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
            } else {
                // Verificar se as senhas correspondem
                if ($senha1 !== $senha2) {
                    $resultado["msg"] = "As senhas não correspondem. Por favor, verifique e tente novamente.";
                    $resultado["cod"] = 0;
                    $resultado["style"] = "alert-danger";
                } else {
                    // Hash da senha usando Bcrypt
                    $senha_hash = password_hash($senha1, PASSWORD_BCRYPT);

                    // Inserir usuário no banco de dados
                    $sql = "INSERT INTO usuario (nome, email, senha1, situacao) VALUES (?, ?, ?, 'habilitado')";
                    $stmt = $conn->prepare($sql);

                    // Execute a inserção e verifique se foi bem-sucedida
                    if ($stmt->execute([$nome, $email, $senha_hash])) {
                        $resultado["msg"] = "Usuário cadastrado com sucesso!";
                        $resultado["cod"] = 1;
                        $resultado["style"] = "alert-success";

                        // Redirecionamento após o cadastramento bem-sucedido
                        header("Location: produto.php");
                        exit; // Importante para garantir que o script pare aqui e o redirecionamento seja efetuado
                    } else {
                        $resultado["msg"] = "Erro ao cadastrar usuário. Por favor, tente novamente.";
                        $resultado["cod"] = 0;
                        $resultado["style"] = "alert-danger";
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            $resultado["msg"] = "Erro ao cadastrar usuário. Por favor, tente novamente.";
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Senha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <form action="cadastro_usuario.php" method="post">
            <!-- Exibir mensagens de notificação ou erro -->
            <?php if (!empty($resultado)): ?>
                <div class="alert <?php echo $resultado["style"]; ?> alert-dismissible fade show" role="alert">
                    <?php echo $resultado["msg"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Usuário:</label>
                <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp" placeholder="Digite o nome do usuário" required>
            </div>
            <div class="form-group">
                <label for="email_usuario">Email:</label>
                <input type="email" class="form-control" id="email" name="email_usuario" aria-describedby="emailHelp" placeholder="Digite o email" required>
            </div>
            <div class="form-group">
                <label for="senha_usuario1">Senha:</label>
                <input type="password" class="form-control" id="senha1" name="senha1" placeholder="Digite a senha" required>
                <br>
                <label for="senha_usuario2">Confirme sua Senha:</label>
                <input type="password" class="form-control" id="senha2" name="senha2" placeholder="Digite a senha" required>
            </div>
            <button type="submit" class="btn btn-primary" >Criar Senha</button>
          
        </form>
    </div>
</body>
</html>
