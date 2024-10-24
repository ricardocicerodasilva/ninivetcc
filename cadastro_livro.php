<?php
$host = "localhost";
$user = "root";
$pass = "";
$base = "bd_login";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

// Obtenha os dados do formulário
$nome = $_POST['nome'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$datapubli = $_POST['datapubli'];
$edicao = $_POST['edicao'];
$genero = $_POST['genero'];
$unidade = (int)$_POST['unidade']; // Converta para inteiro
$descricao = $_POST['descricao'];

// Usar prepared statements para evitar SQL injection
$stmt = $con->prepare("INSERT INTO LIVRO (nome_livro, autor, genero, edicao, editora, data_publi, quantidade, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

for ($i = 0; $i < $unidade; $i++) {
    $stmt->bind_param("ssssssss", $nome, $autor, $genero, $edicao, $editora, $datapubli, $unidade, $descricao);
    
    if ($stmt->execute()) {
        $last_id = $stmt->insert_id; 
        echo "Cadastro realizado com sucesso! ID gerado: " . $last_id . "<br>";
    } else {
        echo "Erro ao cadastrar o Livro: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$con->close();
?>
<center>
<h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
