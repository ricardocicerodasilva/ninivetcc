<?php
$host = "localhost";
$user = "root";
$pass = "";
$base = "bd_login";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

$rm_aluno = $_POST['rm'];
$responsavel = $_POST['responsavel'];
$idlivro = $_POST['idlivro'];
$dtreserva = $_POST['dtreserva'];

// Usar prepared statements para evitar SQL injection
$stmt = $con->prepare("INSERT INTO reserva (data_reserva,rm_aluno, id_livro,login) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issss", $dtreserva, $rm_aluno, $id_livro, $responsavel);

if ($stmt->execute()) {
    echo "Reserva realizada com sucesso!";
} else {
    echo "Erro ao reservar livro: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
<center>
<h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
