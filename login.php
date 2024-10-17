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

    session_start();
    

    
    // Verifica se o botão foi pressionado e processa o login
    if (isset($_POST['btn-entrar'])) {
        $erros = array();

        if (!empty($_POST['login']) && !empty($_POST['senha'])) {
            $login = mysqli_escape_string($con, $_POST['login']);
            $senha = mysqli_escape_string($con, $_POST['senha']);
            $senha = md5($senha); // Se estiver usando MD5 para criptografar senhas

            // Consulta ao banco de dados
            $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
            $resultado = mysqli_query($con, $sql);

            if (mysqli_num_rows($resultado) > 0) {
                $dados = mysqli_fetch_array($resultado);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                header("Location: home.php");
                exit();
            } else {
                $erros[] = "Usuário ou senha inválidos!";
            }
        } else {
            $erros[] = "O campo login/senha precisa ser preenchido";
        }
    }

    // Exibe os erros, se houver
    if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
    }

  
?>
