<?php
header('Content-Type: application/json');

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receber o código do livro
$codigo = $_GET['codigo'];

// Preparar e executar a consulta
$sql = "SELECT * FROM livros WHERE codigo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se o livro foi encontrado
if ($result->num_rows > 0) {
    $livro = $result->fetch_assoc();
    echo json_encode($livro);
} else {
    echo json_encode(array("error" => "Livro não encontrado"));
}

$stmt->close();
$conn->close();
?>
