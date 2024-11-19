
<?php
include('verifica_login.php');

$nome = $_POST['nome'];
$para = $_POST['email'];
$assunto = $_POST['assunto'];
$corpo = $_POST['mensagem'];

$nextbit = "nextbit2024@gmail.com"; 

$headers = "From: nextbit2024@gmail.com\r\n";
$headers .= "CC: $nextbit\r\n";  

// Enviar o e-mail
if (mail($para, $assunto, $corpo, $headers, $nextbit )) {
    echo "Email enviado para $nextbit com sucesso!";
} else {
    echo "Falha no envio do email, a partir da conta $headers.";
}
?>
