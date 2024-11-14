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
        /* Seu estilo CSS */
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>
<center><h2>Reservas de Livros</h2></center>

<?php
$sql = "
SELECT reserva.num_reserva, reserva.data_reserva, reserva.data_devolucao, reserva.rm_aluno, livro.nome_livro, reserva.status
FROM reserva
JOIN livro ON reserva.id_livro = livro.id_livro
WHERE reserva.status != 'devolvido'
ORDER BY reserva.data_reserva DESC";

$result = $con->query($sql);

if ($result === FALSE) {
    echo "<center><p>Erro ao buscar reservas: " . $con->error . "</p></center>";
} else {
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

        while ($row = $result->fetch_assoc()) {
            $statusClass = '';
            if ($row["status"] == 'ativo') $statusClass = 'ativo';
            elseif ($row["status"] == 'pendente') $statusClass = 'pendente';
            elseif ($row["status"] == 'atrasado') $statusClass = 'atrasado';

            echo "<tr>
                    <td>" . $row["num_reserva"] . "</td>
                    <td>" . date('d/m/Y', strtotime($row["data_reserva"])) . "</td>
                    <td>" . date('d/m/Y', strtotime($row["data_devolucao"])) . "</td>
                    <td>" . $row["rm_aluno"] . "</td>
                    <td>" . $row["nome_livro"] . "</td>
                    <td class='status " . $statusClass . "'>" . ucfirst($row["status"]) . "</td>
                    <td>
                    <a href='devolucao.php?id_reserva=" . $row['num_reserva'] . "'>Devolver</a>
                    </td>
                </tr>";
        }

        echo "</tbody></table></center>";
    } else {
        echo "<center><p>Nenhuma reserva encontrada.</p></center>";
    }
}

$con->close();
?>
</body>
</html>
