<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Livro</title>
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
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>


    <h2>Buscar Livro</h2>

    

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
</head>

<body>
<!-- Formulário de Busca -->
<form method="post">
    <label for="nome_livro">Título:</label>
    <input type="text" name="nome_livro" id="nome_livro" required>
    <input type="submit" name="buscar" value="Buscar">
</form>

<?php
if (isset($_POST['buscar'])) {
    // Conectar ao banco de dados (certifique-se de que a variável $con está configurada corretamente)
    // Exemplo: $con = new mysqli('localhost', 'usuario', 'senha', 'database');

    $nome_livro = $_POST['nome_livro'];

    // Preparar a consulta SQL para buscar o livro pelo título
    $sql = "SELECT * FROM livro WHERE nome_livro LIKE ?";
    $stmt = $con->prepare($sql);

    // Adicionar os coringas para busca parcial
    $nome_livro_param = "%" . $nome_livro . "%";
    $stmt->bind_param("s", $nome_livro_param); // "s" para string

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se algum livro foi encontrado
    if ($result->num_rows > 0) {
        // Exibir os detalhes do livro na tabela
        while ($livro = $result->fetch_assoc()) {
            ?>
            <h2>Detalhes do Livro</h2>
            <table>
                <tr>
                    <th>Tombo</th>
                    <td><?php echo $livro["id_livro"]; ?> </td>
                </tr>
                <tr>
                    <th>Data de cadastro</th>
                    <td><?php echo $livro["data_cadastro"]; ?> </td>
                </tr>
                <tr>
                    <th>Arquivado</th>
                    <td><?php echo $livro["arquivar_livro"] == 1 ? "Sim" : "Não"; ?></td>
                </tr>
                <tr>
                    <th>Título</th>
                    <td><?php echo $livro['nome_livro']; ?></td>
                </tr>
                <tr>
                    <th>Subtítulo</th>
                    <td><?php echo $livro['subtitulo']; ?></td>
                </tr>
                <tr>
                    <th>Cdd</th>
                    <td><?php echo $livro['cdd']; ?></td>
                </tr>
                <tr>
                    <th>Cutter</th>
                    <td><?php echo $livro['cutter']; ?></td>
                </tr>
                <tr>
                    <th>Autor</th>
                    <td><?php echo $livro['autor']; ?></td>
                </tr>
                <tr>
                    <th>Série/Coleção</th>
                    <td><?php echo $livro['serie_colecao']; ?></td>
                </tr>
                <tr>
                    <th>Edição</th>
                    <td><?php echo $livro['edicao']; ?></td>
                </tr>
                <tr>
                    <th>Local</th>
                    <td><?php echo $livro['local']; ?></td>
                </tr>
                <tr>
                    <th>Editor</th>
                    <td><?php echo $livro['editor']; ?></td>
                </tr>
                <tr>
                    <th>Data de publicação</th>
                    <td><?php echo $livro['data_publicacao']; ?></td>
                </tr>
                <tr>
                    <th>Aquisição</th>
                    <td><?php echo $livro['aquisicao']; ?></td>
                </tr>
                <tr>
                    <th>Exemplar</th>
                    <td><?php echo $livro['exemplar']; ?></td>
                </tr>
                <tr>
                    <th>Língua</th>
                    <td><?php echo $livro['lingua']; ?></td>
                </tr>
                <tr>
                    <th>Observação</th>
                    <td><?php echo $livro['observacao']; ?></td>
                </tr>
                <tr>
                    <th>Capa</th>
                    <td><img src="<?php echo $livro['capa_livro']; ?>" width="50" height="50"></td>
                </tr>
            </table>
            <?php
        }
    } else {
        echo "<p>Nenhum livro encontrado com esse título.</p>";
    }
    $stmt->close();
 $con->close();
}


       

       
    
    ?>

    
</body>

</html>
