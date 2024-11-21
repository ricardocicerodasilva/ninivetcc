<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Conexão com o Banco de Dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
            font-size:30px;
        }
        h3 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <?php
        $host = "localhost";
        $port = "3306";
        $user = "root";
        $pass = "";
        $base = "agenda_compromissos";

        // Tenta fazer a conexão com o banco de dados
        $con = mysqli_connect($host, $user, $pass, $base, $port);

        // Verifica se houve algum erro na conexão
        if (!$con) {
            echo "<div class='message'>Erro ao conectar ao banco de dados: " . mysqli_connect_error() . "</div>";
        } else {
            echo "<div class='message'>Conexão Ok</div>";
        }

        // Fecha a conexão
        mysqli_close($con);
        ?>
    </div>
    <h3><a href='index.php'>Voltar para a página inicial</a></h3>
</body>
</html>

