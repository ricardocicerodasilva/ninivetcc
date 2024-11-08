<?php


include('verifica_login.php');
include('includes/db.php');

$rm_aluno = $_POST['rm'];
$nome_aluno = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$turma = $_POST['turma'];
$periodo = $_POST['periodo'];
$senha = $_POST['senha'];

// Usar prepared statements para evitar SQL injection
$stmt = $con->prepare("INSERT INTO aluno (rm_aluno, nome_aluno, email, telefone, turma, periodo, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssss", $rm_aluno, $nome_aluno, $email, $telefone, $turma, $periodo, $senha);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar o Aluno: " . $stmt->error;
}

$stmt->close();
$con->close();
?>

