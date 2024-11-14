<?php
include('verifica_login.php');
include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações de Reserva</title>
    <style>
        /* Seu estilo aqui */
    </style>
</head>
<body>
<a href="home.php"><img class="image" src="assets/ninive.png" alt="Descrição da Imagem"></a>
<h2>Notificações</h2>

<?php
$sql = "SELECT r.num_reserva, r.data_reserva, r.data_devolucao, r.rm_aluno, r.id_livro, 
        c.confirmar_reserva, c.confirmar_devolucao
        FROM reserva r
        LEFT JOIN confirma_reserva c ON r.num_reserva = c.num_reserva
        WHERE c.confirmar_reserva IS NULL OR c.confirmar_reserva = FALSE";

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

    while ($row = $result->fetch_assoc()) {
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

    echo "</table></center>";
} else {
    echo "<p>Nenhuma notificação de reserva pendente.</p>";
}

$con->close();
?>
</body>
</html>
