<?php
include('verifica_login.php');
include('includes/db.php');

// Verifica se os campos necessários estão preenchidos
if (isset($_POST['rm'], $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['turma'], $_POST['periodo'], $_POST['senha'])) {
    $rm_aluno = $_POST['rm'];
    $nome_aluno = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $turma = $_POST['turma'];
    $periodo = $_POST['periodo'];
    $senha = $_POST['senha'];

    // Prepara e executa a query de atualização
    $stmt = $con->prepare("UPDATE aluno SET nome_aluno=?, email=?, telefone=?, turma=?, periodo=?, senha=? WHERE rm_aluno=?");
    $stmt->bind_param("sssssss", $nome_aluno, $email, $telefone, $turma, $periodo, $senha, $rm_aluno);

    if ($stmt->execute()) {
        // Sucesso na atualização
        echo json_encode(['status' => 'success', 'message' => 'Aluno atualizado com sucesso!']);
    } else {
        // Erro na execução
        echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o aluno: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    // Campos faltando
    echo json_encode(['status' => 'error', 'message' => 'Por favor, preencha todos os campos.']);
}

$con->close();
?>
