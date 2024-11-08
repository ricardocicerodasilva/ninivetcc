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
    margin: 10px 0; /* Ajusta o espaçamento ao redor */
}
     

      label {
        font-family: Arial, sans-serif;
            margin-bottom: 5px;
            font-weight: bold;
            font-size:30px
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
        font-family:Arial, sans-serif;
        font-weight: bold;
        
        
    }
    th {
        background-color: bold;
        color: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
       
    </style>

<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

</head>
<body>

<h2 style="text-align:center">Gerar Relatório de Empréstimos</h2>

<form method="post">
    <label>Mês:</label>
    <input type="number" name="mes" min="1" max="12" value="<?= htmlspecialchars(date('m')) ?>" required>
    <label>Ano:</label>
    <input type="number" name="ano" min="2000" max="2099" value="<?= htmlspecialchars(date('Y')) ?>" required><br>

    <label>Nome do relatório</label>
    <input type="text" name="descricao" id="descricao" required >
    <button type="submit" name="gerar_relatorio" class="submit-button">Gerar Relatório</button>
</form>

<?php
// Verifica se o formulário foi submetido
if (isset($_POST['gerar_relatorio'])) {
    // Captura o mês e o ano selecionados pelo usuário
    $mes_atual = $_POST['mes'];
    $ano_atual = $_POST['ano'];

    // Consulta para obter os dados de empréstimos do mês e ano selecionados
    $sql = "SELECT r.data_reserva, r.data_devolucao, l.nome_livro, b.login AS bibliotecario, a.nome_aluno
            FROM reserva r
            JOIN livro l ON r.id_livro = l.id_livro
            JOIN bibliotecario b ON r.login = b.login
            JOIN aluno a ON r.rm_aluno = a.rm_aluno
            WHERE MONTH(r.data_reserva) = '$mes_atual' AND YEAR(r.data_reserva) = '$ano_atual'";

    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        // Exibe o relatório na tela
        echo "<center><h3>Relatório de Empréstimos - $mes_atual/$ano_atual</h3></center>";
        echo "<table>
                <tr>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                    <th>Nome do Livro</th>
                    <th>Bibliotecário</th>
                    <th>Nome do Aluno</th>
                </tr>";

        // Inicializa o buffer de saída para salvar o conteúdo em um arquivo
        ob_start();

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["data_reserva"]) . "</td>
                    <td>" . htmlspecialchars($row["data_devolucao"]) . "</td>
                    <td>" . htmlspecialchars($row["nome_livro"]) . "</td>
                    <td>" . htmlspecialchars($row["bibliotecario"]) . "</td>
                    <td>" . htmlspecialchars($row["nome_aluno"]) . "</td>
                  </tr>";
        }

        echo "</table>";

        // Salva o conteúdo do relatório em um arquivo
        $conteudo = ob_get_clean();
        $filename = 'relatorios/relatorio_' . date('Y-m-d_H-i-s') . '.html';
        file_put_contents($filename, $conteudo);

        echo "<p style='text-align: center;'>Relatório gerado com sucesso! <a href='$filename' target='_blank'>Visualizar Relatório</a></p>";

    } else {
        echo "<center><p>Nenhum resultado encontrado para o período selecionado.</p></center>";
    }
}

// Fecha a conexão com o banco de dados
$con->close();
?>

</body>
</html>
