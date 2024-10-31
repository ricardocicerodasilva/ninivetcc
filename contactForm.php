<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Carrega o autoloader do Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $mensagem = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP do provedor
        $mail->SMTPAuth = true;
        $mail->Username = 'seuemail@gmail.com'; // Seu email
        $mail->Password = 'suasenha'; // Senha do email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurações do e-mail
        $mail->setFrom($email, $nome);
        $mail->addAddress('destinatario@exemplo.com');
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem de contato';
        $mail->Body = "<p><strong>Nome:</strong> $nome</p>
                       <p><strong>Email:</strong> $email</p>
                       <p><strong>Mensagem:</strong><br>$mensagem</p>";

        // Enviar
        $mail->send();
        echo 'Email enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
?>
