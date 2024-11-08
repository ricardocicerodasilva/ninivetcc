<?php
include('verifica_login.php');
include('includes/db.php');

$rmAluno = $_SESSION['rm'];  // Supondo que o RM do aluno esteja armazenado na sessão

$sql = "SELECT * FROM reserva WHERE rm_aluno = ? AND status = 'ativo'";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $rmAluno);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['reservaAtiva' => true]);
} else {
    echo json_encode(['reservaAtiva' => false]);
}

$stmt->close();
$con->close();
?>
