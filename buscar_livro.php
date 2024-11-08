<?php


include('verifica_login.php');
include('includes/db.php');



if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];

    // Prepare a consulta para evitar SQL injection
    $stmt = $con->prepare("SELECT * FROM livro WHERE nome_livro = ?");
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
