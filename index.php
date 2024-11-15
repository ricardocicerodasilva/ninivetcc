<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <style>
        body {
            background-image: url('assets/ninive.png');
            background-size: 50%; /* Diminui a imagem de fundo */
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: #D2DCE5;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;  
        }
        .button-container {
        display: flex;
         justify-content: center; /* Alinha os botões no centro horizontalmente */
        gap: 10px; /* Espaço entre os botões */
        margin-top: 20px; /* Espaço acima do contêiner de botões */
        }
        .button {
            width: 30%;
            padding: 10px;
            background-color: #0a6789;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto;
                     
        }

        .button:hover {
            background-color: #676767;
        }

        label {
            font-weight: 800;
        }
       /* .btn{
            position: fixed;
             top: 20px;
            right: 20px;
             background-color: #ff4d4d;
          
            padding: 10px;
            background-color: #0a6789;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
           display: block;              
        }
        .btn:hover{
            background-color: #676767;
        }*/
    </style>
</head>
<body>
<form method="POST" >
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required><br>

    <button type="submit" name="acessar" class="button">Entrar</button>
</form>

</body>
</html>

<?php
session_start(); // Inicia a sessão

include('includes/db.php');

// Se o usuário já estiver logado, redirecione para a página inicial
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: home.php");
    exit();
}

if (isset($_POST['acessar'])) {
    $login = $_POST['login']; // Corrigido aqui
    $senha = $_POST['senha'];
    $senha = md5($senha); // Se estiver usando MD5 para criptografar senhas

    // Utilize prepared statements para evitar SQL Injection
    $stmt = $con->prepare("SELECT * FROM bibliotecario WHERE login = ? AND senha = ?");
    $stmt->bind_param("ss", $login, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bibliotecario = $result->fetch_assoc();
        $_SESSION['loggedin'] = true; // Define a variável de sessão
        $_SESSION['login'] = $bibliotecario['login']; // Armazena o login do bibliotecário na sessão
        $_SESSION['foto_perfil'] = $bibliotecario['foto_perfil']; // Armazena o caminho da foto de perfil
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Usuário ou senha inválidos!');</script>"; // Melhora a notificação de erro
    }

    $stmt->close();
}

mysqli_close($con);
?>
