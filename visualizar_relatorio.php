<?php
include('verifica_login.php');
include('includes/db.php');

// Consulta para buscar todos os relatórios
$sql = "SELECT id, descricao, data_geracao FROM relatorio_mensal ORDER BY data_geracao DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Relatórios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #0a6789;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .view-link, .delete-link {
            color: #0a6789;
            text-decoration: none;
            font-weight: bold;
        }

        .view-link:hover, .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Relatórios Mensais</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <table id="relatorioTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Relatório</th>
                        <th>Data de Geração</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr id="relatorio-<?= $row['id'] ?>">
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['descricao']) ?></td>
                            <td><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($row['data_geracao']))) ?></td>
                            <td>
                                <a href="visualizar_relatorio.php?id=<?= $row['id'] ?>" class="view-link">Visualizar</a> &nbsp;&nbsp;
                                <a href="javascript:void(0);" class="delete-link" onclick="excluirRelatorio(<?= $row['id'] ?>)">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <script>
                // Função para excluir o relatório
                function excluirRelatorio(id) {
                    if (confirm("Tem certeza que deseja excluir este relatório?")) {
                        // Envia uma requisição para excluir o relatório
                        fetch('excluir_relatorio.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'id=' + id
                        })
                        .then(response => response.text())
                        .then(data => {
                            if (data.trim() === 'success') {
                                alert("Relatório excluído com sucesso!");
                                // Remove a linha da tabela sem atualizar a página
                                const row = document.getElementById('relatorio-' + id);
                                row.remove();
                            } else {
                                alert("Erro ao excluir o relatório.");
                            }
                        })
                        .catch(error => {
                            alert("Erro na requisição: " + error);
                        });
                    }
                }
            </script>
        <?php else: ?>
            <p style="text-align: center;">Nenhum relatório encontrado.</p>
        <?php endif; ?>

        <?php $con->close(); ?>
    </div>
</body>
</html>

