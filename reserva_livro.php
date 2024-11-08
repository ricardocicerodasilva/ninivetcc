<?php
include('verifica_login.php');  // Verifica o login do usuário
include('includes/db.php');      // Conecta ao banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegando os dados do formulário
    $nomeLivro = $_POST['nomeLivro'];
    $rmAluno = $_POST['rmAluno'];
    $dataReserva = $_POST['dataReserva'];
    $dataDevolucao = $_POST['dataDevolucao'];

    // Verificando se o livro está disponível
    $sqlLivro = "SELECT id_livro FROM livro WHERE nome_livro = ? AND status = 'disponivel' LIMIT 1";
    $stmt = $con->prepare($sqlLivro);
    $stmt->bind_param("s", $nomeLivro);
    $stmt->execute();
    $stmt->store_result();

    // Se o livro estiver disponível
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idLivro);
        $stmt->fetch();

        // Inserir a reserva no banco de dados
        $sqlReserva = "INSERT INTO reserva (id_livro, rm_aluno, data_reserva, data_devolucao, status) VALUES (?, ?, ?, ?, 'ativo')";
        $stmtReserva = $con->prepare($sqlReserva);
        $stmtReserva->bind_param("isss", $idLivro, $rmAluno, $dataReserva, $dataDevolucao);

        if ($stmtReserva->execute()) {
            // Atualizar o status do livro para 'reservado'
            $sqlAtualizaLivro = "UPDATE livro SET status = 'reservado' WHERE id_livro = ?";
            $stmtAtualizaLivro = $con->prepare($sqlAtualizaLivro);
            $stmtAtualizaLivro->bind_param("i", $idLivro);
            $stmtAtualizaLivro->execute();

            echo "Reserva realizada com sucesso!";
        } else {
            echo "Erro ao realizar a reserva.";
        }
    } else {
        echo "Livro não disponível para reserva.";
    }

    // Fechar conexões
    $stmt->close();
    $stmtReserva->close();
    $con->close();
}
?>
