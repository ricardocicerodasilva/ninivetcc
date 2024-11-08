<?php

include('verifica_login.php');
include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arquivar Livro</title>
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

       /* .form-group {
            display: flex;
            flex-direction: column;
        }
*/
      label {
        font-family: Arial, sans-serif;
            margin-bottom: 5px;
            font-weight: bold;
            font-size:30px
        }


        input[type="submit"] {
            background-color: #0a6789;
            color: white;
            justify-content: center;
            padding: 12px 17px;
            border: none;
            margin: 0 auto;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            position: relative;
            display: flex;
           
        }

        input[type="submit"]:hover {
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


 
<?php


// Verifica se o formulário foi enviado para arquivar/ativar o livro
if (isset($_POST['arquivar'])) {
    $codigoLivro = $_POST['codigoLivro'];
    $motivo = isset($_POST['motivo_arq']) ? $_POST['motivo_arq'] : null;
    $novoStatus = $_POST['arquivar_livro'] == 1 ? 0 : 1;

    // Atualiza o status de arquivamento no banco de dados
    $sqlUpdate = "UPDATE livro SET arquivar_livro = ?, motivo_arq = ? WHERE id_livro = ?";
    $stmt = $con->prepare($sqlUpdate);
    $stmt->bind_param("isi", $novoStatus, $motivo, $codigoLivro);

    if ($stmt->execute()) {
        echo "<script>alert('Status do livro atualizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao atualizar o status do livro.');</script>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arquivar Livro</title>
    
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>
    <form method="post">
        <label for="codigoLivro">Código do Livro:</label>
        <input type="number" name="codigoLivro" id="codigoLivro" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php
    if (isset($_POST['buscar'])) {
        $codigoLivro = $_POST['codigoLivro'];

        // Consulta o livro no banco de dados
        $sql = "SELECT id_livro, nome_livro, arquivar_livro FROM livro WHERE id_livro = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $codigoLivro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $livro = $result->fetch_assoc();
    ?>
            <form method="post">
                <h2>Detalhes do Livro</h2>
                <table>
                    <tr>
                        <th>Código</th>
                        <td><?php echo htmlspecialchars($livro['id_livro']); ?></td>
                    </tr>
                    <tr>
                        <th>Nome do livro</th>
                        <td><?php echo htmlspecialchars($livro['nome_livro']); ?></td>
                    </tr>
                    <tr>
                        <th>Arquivado</th>
                        <td><?php echo $livro['arquivar_livro'] == 1 ? "Sim" : "Não"; ?></td>
                    </tr>
                </table>

                <?php
                if ($livro['arquivar_livro'] == 1) {
                    echo "<input type='hidden' name='motivo_arq' id='motivo_arq' value=''>";
                } else {
                    echo "<label>Motivo do arquivamento:</label><textarea name='motivo_arq' required></textarea>";
                }
                ?>

                <input type="hidden" name="codigoLivro" value="<?php echo htmlspecialchars($livro['id_livro']); ?>">
                <input type="hidden" name="arquivar_livro" value="<?php echo htmlspecialchars($livro['arquivar_livro']); ?>">

                <input type="submit" name="arquivar" value="<?php echo $livro['arquivar_livro'] == 1 ? 'Ativar' : 'Arquivar'; ?>">
            </form>

    <?php
        } else {
            echo "Livro não encontrado.";
        }
        $stmt->close();
    }
    $con->close();
    ?>
</body>
</html>


