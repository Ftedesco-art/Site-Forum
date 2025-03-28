<?php
 require 'vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
include("conexao.php"); //script de conexão com o php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST") //se vier um request
{
    //pega os dados
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"]; //senha criptografada
    $confirmar_senha = $_POST["confirmar_senha"];

    //fixa o email
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    


    //verifica se o email é válido
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        die("Erro: O email fornecido não é válido");
    }

    if($senha != $confirmar_senha)
    {
        die("Erro: As senhas não coincidem");
    }

    //criptografia
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    //manda pro banco
    $sql = "INSERT INTO Usuarios (nome,email,senha) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome,$email, $senha_hash);
    
    if($stmt->execute())
    {
        echo "Usuário cadastrado com sucesso!";
    }
    else
    {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();

    // Envio de e-mail
   

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "openforum246@gmail.com";
    $mail->Password = "ifpu mzyq ditm bpoz ";
    $codigo = rand(100000, 999999);
    $mail->setFrom($email, $nome);
    $mail->addAddress($email, "OpenForum");

    $subject = "Verificação de Cadastro";
    $message = "Olá, $nome. Para concluir o cadastro do OpenForum, utilize o código de verificação: $codigo";
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        echo "E-mail de verificação enviado!";
    } else {
        echo "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
    }

    // Redireciona para a página de verificação
    header("Location: verificacao.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="reenviar_codigo.php" method="post">
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" required><br><br>
    <input type="submit" value="Verificar Código">
    </form>
    
    <form action="reenviar_codigo.php" method="post">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <button type="submit">Reenviar Código</button>
    </form>
</form>
</body> 
</html>