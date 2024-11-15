<?php
include('verifica_login.php');
include('includes/db.php');

// Verifica se o parâmetro 'id' foi enviado via POST
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']); // Converte para inteiro para segurança

    // Consulta para excluir o relatório
    $stmt = $con->prepare("DELETE FROM relatorio_mensal WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success';  // Envia sucesso se o relatório foi excluído
    } else {
        echo 'error';  // Envia erro se algo deu errado
    }

    $stmt->close();
} else {
    echo 'error';  // Envia erro se o ID não for encontrado
}

$con->close();
?>
