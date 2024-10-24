<?php
include('verifica_login.php');

if (isset($_POST['arquivar'])) {
    $id_livro = $_POST['codigoLivro'];
    $arquiva_livro = $_POST['arquivar_livro'];
    $motivo_arq = $_POST['motivo_arq'];

    // Prepare a query com valores diretos
    if ($arquiva_livro == 1) { // Desarquivar
        $sql = "UPDATE livro SET arquivar_livro = false, motivo_arq = $motivo_arq WHERE id_livro = $id_livro";
        echo "Livro Ativado com sucesso!";
    } else { // Arquivar
        echo "Livro arquivado com sucesso!";
        $sql = "UPDATE livro SET arquivar_livro = true, motivo_arq = '$motivo_arq' WHERE id_livro = $id_livro";
    }

    // Executar a consulta
    if ($con->query($sql) === TRUE) {
        // Mensagem de sucesso já está dentro da condição anterior
    } else {
        echo "Erro ao atualizar o status do livro: " . $con->error;
    }
}

$con->close();
?>

<center>
    <h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>