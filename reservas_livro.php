<?php
include('verifica_login.php');
include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Reservas</title>
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
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 3px solid black;
            margin-top: 70px;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid black;
            font-size: 16px;
        }
        th {
            background-color: #0a6789;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
            font-size: 50px;
        }
        .status {
            font-weight: bold;
        }
        .ativo {
            color: green;
        }
        .pendente {
            color: orange;
        }
        .atrasado {
            color: red;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>
<center><h2>Reservas de Livros</h2></center>

<?php
// Consulta SQL para buscar reservas e os detalhes do livro associado
$sql = "
    SELECT reserva.num_reserva, reserva.data_reserva, reserva.data_devolucao, reserva.rm_aluno, livro.nome_livro, reserva.status
    FROM reserva
    JOIN livro ON reserva.id_livro = livro.id_livro
    ORDER BY reserva.data_reserva DESC"; // Ordenar pela data de reserva mais recente

$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<center>
            <table>
                <thead>
                    <tr>
                        <th>ID Reserva</th>
                        <th>Data de Reserva</th>
                        <th>Data de Devolução</th>
                        <th>RM do Aluno</th>
                        <th>Nome do Livro</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";

    // Exibe as reservas
    while ($row = $result->fetch_assoc()) {
        // Determina a classe do status (ativo, pendente ou atrasado)
        $statusClass = '';
        if ($row["status"] == 'ativo') {
            $statusClass = 'ativo';
        } elseif ($row["status"] == 'pendente') {
            $statusClass = 'pendente';
        } elseif ($row["status"] == 'atrasado') {
            $statusClass = 'atrasado';
        }
        
        // Exibe cada linha da reserva
        echo "<tr>
                <td>" . $row["num_reserva"] . "</td>
                <td>" . date('d/m/Y', strtotime($row["data_reserva"])) . "</td>
                <td>" . date('d/m/Y', strtotime($row["data_devolucao"])) . "</td>
                <td>" . $row["rm_aluno"] . "</td>
                <td>" . $row["nome_livro"] . "</td>
                <td class='status " . $statusClass . "'>" . ucfirst($row["status"]) . "</td>
                <td>
                    <a href='devolver_livro.php?id_reserva=" . $row['num_reserva'] . "'>Devolver</a>
                    <!-- Outras ações como cancelar ou editar a reserva podem ser inseridas aqui -->
                </td>
            </tr>";
    }

    echo "</tbody></table></center>";
} else {
    echo "<center><p>Nenhuma reserva encontrada.</p></center>";
}

// Fecha a conexão com o banco de dados
$con->close();
?>
</body>
</html>
