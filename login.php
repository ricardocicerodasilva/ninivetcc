<?php
session_start();

include('includes/db.php');


// Verifica se o botão foi pressionado e processa o login
if (isset($_POST['btn-entrar'])) {
    $erros = array();

    if (!empty($_POST['loggedin']) && !empty($_POST['senha'])) {
        $login = mysqli_escape_string($con, $_POST['login']);
        $senha = mysqli_escape_string($con, $_POST['senha']);
        $senha = md5($senha); // Se estiver usando MD5 para criptografar senhas

        // Consulta ao banco de dados
        $sql = "SELECT id_bibli, login, usuario_tipo FROM bibliotecario WHERE login = '$login' AND senha = '$senha'";
        $resultado = mysqli_query($con, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $dados = mysqli_fetch_array($resultado);
            print_r($dados); // Verifica o que está sendo recuperado

            $_SESSION['loggedin'] = true;
            $_SESSION['id_bibli'] = $dados['id_bibli'];
            $_SESSION['loggedin'] = $dados['login'];
            $_SESSION['usuario_tipo'] = $dados['usuario_tipo']; // Armazena `usuario_tipo` na sessão

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
