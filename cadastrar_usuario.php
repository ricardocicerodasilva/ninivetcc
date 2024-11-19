<?php
session_start(); // Inicia a sessão para garantir que a sessão foi carregada

include('verifica_login.php');
include('includes/db.php');

// Verificar se o usuário está logado e se é admin
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    // Se não for admin, redireciona para a página de login ou outra página de erro
    header('Location: home.php'); // Ou pode ser redirecionado para a página de erro
    exit();
}
?>



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('assets/imgcadastro.jpg');
            background-repeat: no-repeat;
            background-size: cover; /* Ajusta a largura para 100% e a altura para 50% */
            height:auto;
                       
        }
        .image {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
            z-index: 1000;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            height:400px;
            margin:0 auto;
            margin-top:120px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"], input[type="password"], input[type="file"] {
            width: 80%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        

        button[type="submit"] {
    background-color: #0a6789;
   width: 30%;
    color: white;
    justify-content:center;
    padding: 12px 10px;
    border: none;
   margin: 0 auto; /* Centraliza horizontalmente */
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
    position: relative;
    display: flex;
    margin-top:40px;
    
        }
        button[type="submit"]:hover {
            background-color: #676767;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<form method="POST" enctype="multipart/form-data">
    <h2>Cadastrar Usuário</h2>

    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>

    <label for="foto">Foto de Perfil:</label>
    <input type="file" id="foto" name="foto" accept="image/*">

    <button type="submit" name="cadastrar" class="button">Cadastrar</button>
</form>

</body>
</html>

<?php


if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    $pasta_destino = "assets/perfil/";
    if (!is_dir($pasta_destino)) {
        mkdir($pasta_destino, 0777, true);
    }
    $nome_arquivo = uniqid() . "_" . basename($foto['name']);
    $caminho_arquivo = $pasta_destino . $nome_arquivo;

    if (move_uploaded_file($foto['tmp_name'], $caminho_arquivo)) {
        $stmt = $con->prepare("INSERT INTO bibliotecario (login, senha, foto_perfil) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login, $senha, $caminho_arquivo);
        $stmt->execute();
        $stmt->close();
        echo "<p>Usuário cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao salvar a imagem.</p>";
    }
} else {
    echo "<p>Erro ao fazer o upload da imagem.</p>";
}

$con->close();
?>
