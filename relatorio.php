<?php
include('verifica_login.php');
include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Empréstimos</title>
    <style>
        /* Seu CSS */
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
            font-weight: bold;
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

        input {
            gap: 40px;
            max-width: 600px;
            margin: 20px;
            width: 10%;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        #descricao {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin: 10px 0;
        }

        label {
            font-family: Arial, sans-serif;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 30px;
        }

        button[type="submit"] {
            background-color: #0a6789;
            color: white;
            justify-content: center;
            padding: 12px 20px;
            border: none;
            margin: 0 auto;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            position: relative;
            display: flex;
        }

        button[type="submit"]:hover {
            background-color: #676767;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 4px solid #ddd;
            padding: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<h2>Gerar Relatório de Empréstimos</h2>

<form method="post">
    <label>Mês:</label>
    <input type="number" name="mes" min="1" max="12" value="<?= htmlspecialchars(date('m')) ?>" required>
    <label>Ano:</label>
    <input type="number" name="ano" min="2000" max="2099" value="<?= htmlspecialchars(date('Y')) ?>" required><br>
    <label>Nome do relatório</label>
    <input type="text" name="descricao" id="descricao" required>
    <button type="submit" name="gerar_relatorio">Gerar Relatório</button>
</form>

<?php
if (isset($_POST['gerar_relatorio'])) {
    $mes_atual = $_POST['mes'];
    $ano_atual = $_POST['ano'];
    $descricao = $_POST['descricao'];

    $sql = "SELECT r.data_reserva, r.data_devolucao, l.nome_livro, a.nome_aluno
            FROM reserva r
            JOIN livro l ON r.id_livro = l.id_livro
            JOIN aluno a ON r.rm_aluno = a.rm_aluno
            WHERE MONTH(r.data_reserva) = ? AND YEAR(r.data_reserva) = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $mes_atual, $ano_atual);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $conteudo = "<center><h3>Relatório de Empréstimos - $mes_atual/$ano_atual</h3></center>";
        $conteudo .= "<table>
                        <tr>
                            <th>Data de Empréstimo</th>
                            <th>Data de Devolução</th>
                            <th>Nome do Livro</th>
                            <th>Nome do Aluno</th>
                        </tr>";

        while ($row = $result->fetch_assoc()) {
            $conteudo .= "<tr>
                            <td>" . htmlspecialchars($row["data_reserva"]) . "</td>
                            <td>" . htmlspecialchars($row["data_devolucao"]) . "</td>
                            <td>" . htmlspecialchars($row["nome_livro"]) . "</td>                            
                            <td>" . htmlspecialchars($row["nome_aluno"]) . "</td>
                          </tr>";
        }
        $conteudo .= "</table>";

        $stmt = $con->prepare("INSERT INTO relatorio_mensal (mes, ano, descricao, conteudo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $mes_atual, $ano_atual, $descricao, $conteudo);

        if ($stmt->execute()) {
            $relatorio_id = $con->insert_id;
            echo "<p style='text-align: center;'>Relatório gerado e salvo com sucesso! 
                  <a href='visualizar_relatorio.php?id=$relatorio_id' onclick='alert(\"Relatório salvo no banco de dados.\")'>Visualizar Relatório</a></p>";
        } else {
            echo "<center><p>Erro ao salvar o relatório: " . $stmt->error . "</p></center>";
        }

        $stmt->close();
    } else {
        echo "<center><p>Nenhum empréstimo encontrado para o período selecionado.</p></center>";
    }
}

$con->close();
?>
</body>
</html>
