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


$sql = "UPDATE aluno SET rm_aluno= $rm_aluno, 
nome_aluno='$nome_aluno', 
email='$email', 
telefone='$telefone', 
turma='$turma', 
periodo='$periodo', 
senha='$senha' 
WHERE rm_aluno= $rm_aluno";

if ($con->query($sql) === TRUE) {
    echo "Atualização realizado com sucesso!";
} else {
    echo "Erro ao atualizar o aluno: " . $con->error;
}
$con->close();
?>
<center>
<h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>