<?php

include('verifica_login.php');


include('includes/db.php');

// Recupera os dados do formulário
$rm_aluno = $_POST['rm_aluno'] ?? null;
$motivo_bloq = $_POST['motivo_bloq'] ?? 'null';
$bloqueado = $_POST['bloqueado'] ?? 0;

// Lógica de bloqueio ou desbloqueio do aluno
if ($bloqueado == 1) {
    // Lógica para desbloquear
    $sql = "UPDATE aluno SET bloqueado = 0 WHERE rm_aluno = ?";
    $message = "Aluno desbloqueado com sucesso";
} else {
    // Lógica para bloquear
    $sql = "UPDATE aluno SET bloqueado = 1, motivo_bloq = ? WHERE rm_aluno = ?";
    $message = "Aluno bloqueado com sucesso";
}

$stmt = $con->prepare($sql);
if ($bloqueado == 1) {
    $stmt->bind_param("i", $rm_aluno);
} else {
    $stmt->bind_param("si", $motivo_bloq, $rm_aluno);
}

if ($stmt->execute()) {
    echo $message;
} else {
    echo "Erro ao atualizar status do aluno.";
}

$stmt->close();
$con->close();
?>
