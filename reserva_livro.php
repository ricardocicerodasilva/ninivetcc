
<?php
include('verifica_login.php');
?>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$base = "etecguaru01";

$con = mysqli_connect($host, $user, $pass, $base);

if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

$id_livro = $_POST['idLivro'];
$rm_aluno = $_POST['rmAluno'];
$data_reserva = $_POST['dataReserva'];
$data_devolucao = $_POST['dataDevolucao'];

$sql = "INSERT INTO reserva (id_livro, rm_aluno, data_reserva, data_devolucao) 
        VALUES ($id_livro, $rm_aluno, '$data_reserva', '$data_devolucao')";


if ($con->query($sql) === TRUE) {
    echo "Reserva realizado com sucesso!";
} else {
    echo "Erro ao cadastrar o Aluno: " . $con->error;
}
$con->close();
?>
<center>
<h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
