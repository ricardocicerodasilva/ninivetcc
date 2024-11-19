<?php
session_start();

include('includes/db.php');

if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); 
    exit();
}

// Verifica se o usuário tem permissão de administrador
if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] !== 'admin') {
    // Redireciona ou exibe mensagem de acesso negado
    echo "Você não tem permissão para acessar esta página.";
    exit();
}

// Variáveis da sessão

$id_bibli = $_SESSION['login'];
$foto_perfil = $_SESSION['foto_perfil'];
?>
