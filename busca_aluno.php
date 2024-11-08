<?php
include('verifica_login.php');

include('includes/db.php');

// Verificando se o campo de busca foi enviado
if (isset($_POST['rm'])) {
    $rm = $_POST['rm'];

    // Comando SELECT para buscar os dados do aluno com base no RM
    $sql = "SELECT * FROM aluno WHERE rm_aluno = ?";
    $stmt = $con->prepare($sql);  // Preparando a consulta SQL
    $stmt->bind_param("s", $rm);  // Passando o valor de $rm
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
        // Retornar os dados como JSON
        echo json_encode($aluno);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
}

$con->close();
