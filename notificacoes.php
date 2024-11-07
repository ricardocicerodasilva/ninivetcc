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


$sql = "SELECT * FROM reserva";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<center><table border='1'>
            <tr>
                <th>ID</th>
                <th>Data de Reserva</th>
                <th>Data de Devolução</th>
                <th>RM do Aluno</th>
                <th>Nome do Livro</th>
                <th>Ação</th>
            </tr>";

    // Exibindo cada linha de dados
    while ($row = $result->fetch_assoc()) {

        $num_reserva = $row["num_reserva"];
        $sql_confirma = "SELECT * FROM confirma_reserva WHERE num_reserva = '$num_reserva'";
        $result_confirma = $con->query($sql_confirma);

        $disponivel = true;

        if ($result_confirma->num_rows > 0) {
            $confirma_row = $result_confirma->fetch_assoc();

            $confirmar_reserva = $confirma_row["confirmar_reserva"];
            $confirmar_devolucao = $confirma_row["confirmar_devolucao"];

            if ($confirmar_reserva && $confirmar_devolucao) {
                $disponivel = false;
            } else {
                $disponivel = !empty($confirma_row["livro_disponivel"]) ? $confirma_row["livro_disponivel"] : false;
            }
        }

        if (!$disponivel) {
            $num_reserva = $row['num_reserva'];
            $sql_verifica_devolucao = "SELECT * FROM confirma_reserva WHERE num_reserva = '$num_reserva' AND confirmar_devolucao = FALSE";
            $result_verifica_devolucao = $con->query($sql_verifica_devolucao);

            if ($result_verifica_devolucao->num_rows > 0) {

                echo "<tr>
                <td>" . $row["num_reserva"] . "</td>
                <td>" . $row["data_reserva"] . "</td>
                <td>" . $row["data_devolucao"] . "</td>
                <td>" . $row["rm_aluno"] . "</td>
                <td>" . $row["id_livro"] . "</td>
                <td>
                    <form method='post' action='devolucao.php'>
                        <input type='hidden' value='" . $row["num_reserva"] . "' name='num_reserva'>
                        <input type='hidden' value='" . $row["rm_aluno"] . "' name='rm_aluno'>
                        <input type='submit' value='Devolução'>
                    </form>
                </td>
            </tr>";
            } else {
                echo "<tr>
                <td>" . $row["num_reserva"] . "</td>
                <td>" . $row["data_reserva"] . "</td>
                <td>" . $row["data_devolucao"] . "</td>
                <td>" . $row["rm_aluno"] . "</td>
                <td>" . $row["id_livro"] . "</td>
                <td>Devolução já confirmada</td>
            </tr>";
            }
        } else {
            echo "<tr>
            <td>" . $row["num_reserva"] . "</td>
            <td>" . $row["data_reserva"] . "</td>
            <td>" . $row["data_devolucao"] . "</td>
            <td>" . $row["rm_aluno"] . "</td>
            <td>" . $row["id_livro"] . "</td>
            <td>
                <form method='post' action='confirma_reserva.php'>
                    <input type='hidden' value='" . $row["num_reserva"] . "' name='num_reserva'>
                    <input type='hidden' value='" . $row["rm_aluno"] . "' name='rm_aluno'>
                    <input type='submit' value='Confirmar'>
                </form>
            </td>
        </tr>";
        }
    }

    echo "</table></center>";
} else {
    echo "Nenhum resultado encontrado.";
}

$con->close();
?>

