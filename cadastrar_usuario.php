<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
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
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

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
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$base = "etecguaru01";
$con = new mysqli($host, $user, $pass, $base);

if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

if (isset($_POST['cadastrar'])) {
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);

    // Tratamento do upload da foto de perfil
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto'];
        $pasta_destino = "assets/";
        $nome_arquivo = uniqid() . "_" . basename($foto['name']);
        $caminho_arquivo = $pasta_destino . $nome_arquivo;

        if (move_uploaded_file($foto['tmp_name'], $caminho_arquivo)) {
            $stmt = $con->prepare("INSERT INTO bibliotecario (login, senha, foto_perfil) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $login, $senha, $caminho_arquivo);
            $stmt->execute();
            $stmt->close();
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao salvar a imagem.";
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
}

$con->close();
?>