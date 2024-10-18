<?php
// Inicia a sessão apenas se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "bd_login";
$con   = mysqli_connect($host, $user, $pass, $base);

// Verifica se a conexão foi estabelecida corretamente
if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: index.php");
    exit();
}

// Opcional: verificar se id_usuario está definido
if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: usuário não encontrado.";
    exit();
}
?>

 
 