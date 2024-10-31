<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Acervo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('assets/imgcadastro.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: auto;
        }

        .image {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
            z-index: 1000;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 40px;
        }

        form {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .formulario {
            display: grid;
            gap: 20px;
            max-width: 800px;
            margin: auto;
        }

        .notifications {
            list-style: none;
            padding: 0;
        }

        .notification-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

    <h2>Notificações</h2>

    <?php


// Conexão com o banco de dados
$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "etecguaru01";
$con   = mysqli_connect($host, $user, $pass, $base);

if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Consulta para obter dados de reserva com o nome do livro
$sql = "SELECT reserva.*, livro.nome_livro 
        FROM reserva
        JOIN livro ON reserva.id_livro = livro.id_livro"; // Ajuste no nome da coluna

$result = $con->query($sql); // Executa a consulta e armazena o resultado em $result

if ($result && $result->num_rows > 0) {
    echo "<center><table border='1'>
            <tr>
                <th>ID</th>
                <th>Data de Reserva</th>
                <th>Data de Devolução</th>
                <th>RM do aluno</th>
                <th>Nome do livro</th>
                <th>Ação</th>
            </tr>";

    // Exibindo cada linha de dados
    while ($row = $result->fetch_assoc()) {

        $num_reserva = $row["num_reserva"];
        $sql_confirma = "SELECT * FROM confirma_reserva WHERE num_reserva = '$num_reserva'";
        $result_confirma = $con->query($sql_confirma);
        
        $disponivel = true; 

        if ($result_confirma && $result_confirma->num_rows > 0) {
            $confirma_row = $result_confirma->fetch_assoc();
            $disponivel = !empty($confirma_row["disponibilidade"]) ? $confirma_row["disponibilidade"] : false;
        }

        if (!$disponivel) {
            continue;
        }

        echo "<tr>
                <td>" . $row["num_reserva"] . "</td>
                <td>" . $row["data_reserva"] . "</td>
                <td>" . $row["data_devolucao"] . "</td>
                <td>" . $row["rm_aluno"] . "</td>
                <td>" . $row["nome_livro"] . "</td>
                <td>                
                    <form method='post' action='confirma_reserva.php'>
                        <input type='hidden' value='" . $row["num_reserva"] . "' name='num_reserva'>
                        <input type='hidden' value='" . $row["rm_aluno"] . "' name='rm_aluno'>
                        <input type='submit' value='confirmar'>
                    </form>
                </td>
              </tr>";
    }

    echo "</table></center>";
} else {
    echo "Nenhum resultado encontrado.";
}

$con->close();
?>
<center>
    <h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
