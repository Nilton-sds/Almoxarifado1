<?php
session_start();
$nome = $_SESSION['usuario_nome'] ?? null;
$erro = $_SESSION['erro_login'] ?? null;
unset($_SESSION['erro_login']); // Limpa mensagem de erro após ler
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Produtos 1.0</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <?php if (isset($nome)): ?>
            <div class="alert alert-success">
                Bem-vindo, <strong><?php echo htmlspecialchars($nome); ?></strong>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Bem-vindo, convidado.<br>
                Para ter acesso total, efetue o login.
            </div>
        <?php endif; ?>

        <h2>Efetue o login</h2>
        <br>

        <?php if ($erro): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($erro); ?>
            </div>
        <?php endif; ?>

        <form id="form_login" action="login.php" method="post">
            <div class="form-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required />
            </div>
            <div class="form-group">
                <input type="password" id="senha1" name="senha1" class="form-control" placeholder="Digite sua senha" required />
            </div>
            <input type="submit" id="submeter" value="Entrar" class="btn btn-primary" />
        </form>
    </div>
</body>
</html>
