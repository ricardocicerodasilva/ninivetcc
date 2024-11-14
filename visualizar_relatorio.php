<?php
include('verifica_login.php');
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $con->prepare("SELECT conteudo FROM relatorio_mensal WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($conteudo);
    $stmt->fetch();

    if ($conteudo) {
        echo $conteudo;
    } else {
        echo "<center><p>Relatório não encontrado.</p></center>";
    }

    $stmt->close();
}

$con->close();
?>
