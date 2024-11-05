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


// Processar a atualização se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['num_reserva'])) {
    $id_notificacao = $_POST['num_reserva'];

    // Atualiza a notificação para marcada como lida
    $update_sql = "UPDATE notificacao SET menssagem_lida = TRUE WHERE id_notificacao = ?";
    $stmt = $con->prepare($update_sql);
    $stmt->bind_param("i", $id_notificacao); // "i" indica que estamos esperando um inteiro

    if ($stmt->execute()) {
        echo "Notificação marcada como lida com sucesso!";
    } else {
        echo "Erro ao atualizar notificação: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM notificacao WHERE menssagem_lida = FALSE";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<center><table border='1'>
            <tr>
                <th>Título da Notificação</th>
                <th>Mensagem</th>
                <th>Lida</th>
            </tr>";

    // Exibindo cada linha de dados
    while ($row = $result->fetch_assoc()) {
        echo "
            <tr>
                <td>" . htmlspecialchars($row["titulo_notificacao"]) . "</td>
                <td>" . htmlspecialchars($row["menssagem_notificacao"]) . "</td>
                <td>                
                    <form method='post'>
                        <input type='hidden' value='" . $row["id_notificacao"] . "' name='num_reserva'>
                        <input type='submit' name='buscar' value='Confirmar'>
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