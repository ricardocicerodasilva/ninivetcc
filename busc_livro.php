<?php
include('verifica_login.php');  // Certifique-se de que está verificando o login do usuário corretamente
include('includes/db.php');      // Conecte-se ao banco de dados

// Verifica se o parâmetro 'nomeLivro' foi enviado via POST
if (isset($_POST['nomeLivro'])) {
    $nomeLivro = $_POST['nomeLivro'];

    // Preparamos a consulta para buscar livros disponíveis
    $sql = "SELECT id_livro FROM livro WHERE nome_livro LIKE ? AND status = 'disponivel' LIMIT 1";
    $stmt = $con->prepare($sql);
    $nomeLivro = "%" . $nomeLivro . "%"; // Adiciona o '%' para permitir busca parcial
    $stmt->bind_param('s', $nomeLivro);  // Ligando o parâmetro para a consulta
    $stmt->execute();
    $stmt->store_result();

    // Verifica se o livro foi encontrado
    if ($stmt->num_rows > 0) {
        // Se o livro estiver disponível, retornamos 'disponivel' como verdadeiro
        echo json_encode(['disponivel' => true]);
    } else {
        // Se não, informamos que o livro não está disponível
        echo json_encode(['disponivel' => false]);
    }

    $stmt->close();  // Fechando a consulta
    $con->close();   // Fechando a conexão com o banco
} else {
    // Caso o parâmetro 'nomeLivro' não esteja definido
    echo json_encode(['error' => 'Parâmetro nomeLivro não fornecido']);
}
?>
