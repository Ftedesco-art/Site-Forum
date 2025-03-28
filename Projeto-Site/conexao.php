<?php
$servidor = "localhost"; //XAMPP usa "localhost" como servidor default (mudo dps sla)
$usuario = "root"; //usuario default do mysql
$senha = ""; //senha default
$banco = "banco"; //nome do banco criado la no phpadmin

//segurança, dados no email do site
putenv("EMAIL_USER=openforum246@gmail.com");
putenv("EMAIL_PASS=pvmh antb yamu vemx");

//conexão com o mysql
$conn = new mysqli($servidor,$usuario,$senha,$banco);

//check se deu certo
if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error); //se deu erro fala qual o erro
}
?>
