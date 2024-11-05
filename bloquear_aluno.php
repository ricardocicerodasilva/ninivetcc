<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloquear Aluno </title>
    <style>
        /* Estilo básico */
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

        /* Logo */
        .image {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
            z-index: 1000;
        }

        /* Título */
        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        /* Formulário de busca */
        form {
            width: 50%;
            margin: 20px auto;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        input[type="number"],
        input[type="text"],
        textarea {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: fit-content;
            background-color: #0a6789;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #676767;
        }

        /* Tabela */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0a6789;
            color: #fff;
            font-weight: bold;
        }

        td {
            font-size: 15px;
            color: #333;
        }

        textarea {
            resize: none;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<form method="post">
    <label for="rm_aluno">RM do aluno(a):</label>
    <input type="number" name="rm_aluno" id="rm_aluno" required>
    <input type="submit" name="buscar" value="Buscar">
</form>

<?php
// Certifique-se de que $con está definido e conectado ao banco de dados

if (isset($_POST['buscar'])) {
    $rm_aluno = $_POST['rm_aluno'];

    // Consultar o aluno
    $sql = "SELECT * FROM aluno WHERE rm_aluno = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $rm_aluno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
?>
        <script>
            function bloquearAluno(event) {
                event.preventDefault();
                const formData = new FormData(event.target);
                
                fetch('bloqueio_aluno.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data || "Aluno bloqueado com sucesso");
                    event.target.reset();
                    
                })
                .catch(error => console.error('Erro:', error));
            }
        </script>

        <form onsubmit="bloquearAluno(event)">
            <h2>Detalhes do aluno</h2>
            <table>
                <tr>
                    <th>RM do aluno(a)</th>
                    <td><?php echo htmlspecialchars($aluno['rm_aluno']); ?></td>
                </tr>
                <tr>
                    <th>Nome do aluno(a)</th>
                    <td><?php echo htmlspecialchars($aluno['nome_aluno']); ?></td>
                </tr>
                <tr>
                    <th>Bloqueado</th>
                    <td><?php echo isset($aluno["bloqueado"]) && $aluno["bloqueado"] == 1 ? "Sim" : "Não"; ?></td>
                </tr>
            </table>
            <?php
            $bloqueado = $aluno['bloqueado'] ?? null;

            if ($bloqueado == 1) {
                echo "<input type='hidden' name='motivo_bloq' id='motivo_bloq' value='null'>";
            } else {
                echo "Motivo do bloqueio:</p>";
                echo "<textarea name='motivo_bloq' id='motivo_bloq' cols='30' rows='10' style='resize: none;' required></textarea></p>";
            }
            ?>
            <input type="hidden" name="rm_aluno" value="<?php echo htmlspecialchars($aluno['rm_aluno']); ?>">
            <input type="hidden" name="bloqueado" value="<?php echo htmlspecialchars($bloqueado); ?>">
            <input type="submit" name="bloquear" value="<?php echo $bloqueado == 1 ? 'Desbloquear' : 'Bloquear'; ?>">
        </form>

<?php
    } else {
        echo "Aluno não encontrado.";
    }

    $stmt->close();
    $con->close();
}
?>
</body>
</html>

