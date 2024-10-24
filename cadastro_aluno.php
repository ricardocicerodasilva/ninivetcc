<?php
$host = "localhost";
$user = "root";
$pass = "";
$base = "bd_login";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

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
<center>
<h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
