<?php
include('verifica_login.php');
include('includes/db.php');

// Verifica se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte para inteiro para segurança

    // Consulta para buscar o conteúdo do relatório com o ID fornecido
    $stmt = $con->prepare("SELECT descricao, conteudo, data_geracao FROM relatorio_mensal WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($descricao, $conteudo, $data_geracao);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "<center><p>ID do relatório não fornecido.</p></center>";
    exit;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Relatório</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .data-geracao {
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }

        .conteudo {
            margin-top: 20px;
            line-height: 1.6;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            background-color: #0a6789;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }

        .button:hover {
            background-color: #676767;
        }

        /* Esconde os botões durante a impressão */
        @media print {
            .button-container, .button {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <?php if (isset($conteudo) && $conteudo): ?>
        <h2><?= htmlspecialchars($descricao) ?></h2>
        <p class="data-geracao">Data de Geração: <?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($data_geracao))) ?></p>
        <div class="conteudo"><?= $conteudo ?></div>

        <div class="button-container">
            <!-- Botão de Imprimir -->
            <button class="button" onclick="window.print()">Imprimir</button>

         
        </div>
    <?php else: ?>
        <p style="text-align: center;">Relatório não encontrado ou conteúdo vazio.</p>
    <?php endif; ?>
</div>

<script>
    // Função para excluir o relatório
    function excluirRelatorio(id) {
        if (confirm("Tem certeza que deseja excluir este relatório?")) {
            // Envia uma requisição para excluir o relatório
            fetch('excluir_relatorio.php?id=' + id, {
                method: 'GET',
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    alert("Relatório excluído com sucesso!");
                    window.location.href = 'listar_relatorios.php'; // Redireciona para a lista de relatórios
                } else {
                    alert("Erro ao excluir o relatório.");
                }
            })
            .catch(error => {
                alert("Erro na requisição.");
            });
        }
    }
</script>
</body>
</html>
