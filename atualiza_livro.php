<?php



include('verifica_login.php');


$host = "localhost";
$user = "root";
$pass = "";
$base = "etecguaru01";

$con = mysqli_connect($host, $user, $pass, $base);

// Verifica se o código do livro foi enviado
if (isset($_POST['titulo'])) {
    //$codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $datapubli = $_POST['datapubli'];
    $edicao = $_POST['edicao'];
    $genero = $_POST['genero'];
    $unidades = $_POST['unidades'];
    $sinopse = $_POST['sinopse'];

    // Usar prepared statements para evitar SQL injection
    $stmt = $con->prepare("UPDATE LIVRO SET nome_livro = ?, autor = ?, editora = ?, data_publicacao = ?, edicao = ?, genero = ?, quantidade = ?, descricao = ? ");
    $stmt->bind_param("ssssssss", $titulo, $autor, $editora, $datapubli, $edicao, $genero, $unidades, $sinopse, );

    if ($stmt->execute()) {
        echo "Livro atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o Livro: " . $stmt->error;
    }

    $stmt->close();
}
$con->close();
?>
