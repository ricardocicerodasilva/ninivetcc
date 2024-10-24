<?php
$host = "localhost";
$user = "root";
$pass = "";
$base = "bd_login";

$con = mysqli_connect($host, $user, $pass, $base);

if (mysqli_connect_errno()) {
    echo json_encode(['error' => 'Falha na conexão com o banco de dados: ' . mysqli_connect_error()]);
    exit();
}

if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];

    // Prepare a consulta para evitar SQL injection
    $stmt = $con->prepare("SELECT * FROM LIVRO WHERE nome_livro = ?");
    $stmt->bind_param("s", $titulo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $livro = $result->fetch_assoc();
        // Retornar os dados como JSON
        echo json_encode($livro);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
}

$con->close();
?>
