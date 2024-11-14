<?php
include('verifica_login.php');
include('includes/db.php');

$sql = "SELECT id, mes, ano, descricao, data_geracao FROM relatorio_mensal ORDER BY data_geracao DESC";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<center><h2>Relatórios Salvos</h2></center>";
    echo "<table>
            <tr>
                <th>Mês</th>
                <th>Ano</th>
                <th>Descrição</th>
                <th>Data de Geração</th>
                <th>Ações</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["mes"] . "</td>
                <td>" . $row["ano"] . "</td>
                <td>" . htmlspecialchars($row["descricao"]) . "</td>
                <td>" . $row["data_geracao"] . "</td>
                <td><a href='visualizar_relatorio.php?id=" . $row["id"] . "' target='_blank'>Visualizar</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<center><p>Nenhum relatório encontrado.</p></center>";
}

$con->close();
?>
