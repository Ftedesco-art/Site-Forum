
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 id="titulo-principal">Formulário de Registro</h1>
<!-- Post = confidencial, Get = aparece na URL -->
    <form action ="verificacao.php" method ="post">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br><br>    

        <label for="confirmar_senha">Confirmar senha:</label>
        <input type="password" name="confirmar_senha" id="confirmar_senha" required><br><br>

        <input type="submit" name="enviar" id="enviar" required><br><br>

    </form>

    
</body>
</html>