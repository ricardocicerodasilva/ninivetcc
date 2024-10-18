


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
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;  
            margin-right: 80px
        }

        .button {
    width: 30%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 0 auto;
}

.button:hover {
    background-color: #45a049;
}


        label {
            font-weight: 800;
        }
    </style>


</head>
<body>
<form action="login.php" method="POST">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login"><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br>

    <button type="submit" name="btn-entrar" class="button">Entrar</button>

</form>

 
</body>
</html>
<?php
// Conexão com o banco de dados
$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "bd_login";
$con   = mysqli_connect($host, $user, $pass, $base);

if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Inicia a sessão
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: home.php");
    exit();
}

// Verifica se o botão foi pressionado e processa o login
if (isset($_POST['btn-entrar'])) {
    $erros = array();

    if (!empty($_POST['login']) && !empty($_POST['senha'])) {
        $login = mysqli_real_escape_string($con, $_POST['login']);
        $senha = mysqli_real_escape_string($con, $_POST['senha']);

        // Consulta ao banco de dados usando prepared statements
        $sql = "SELECT * FROM usuario WHERE login = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $login);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $dados = mysqli_fetch_array($resultado);
            // Verifica a senha usando password_verify()
            if (password_verify($senha, $dados['senha'])) { // Alterar para verificar hash
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                header("Location: home.php");
                exit();
            } else {
                $erros[] = "Usuário ou senha inválidos!";
            }
        } else {
            $erros[] = "Usuário ou senha inválidos!";
        }
    } else {
        $erros[] = "O campo login/senha precisa ser preenchido";
    }

    // Exibe os erros, se houver
    if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
    }

    // Fecha o statement
    mysqli_stmt_close($stmt);
}

// Fecha a conexão com o banco de dados
mysqli_close($con);
?>


