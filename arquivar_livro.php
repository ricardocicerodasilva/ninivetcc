<?php

include('verifica_login.php');
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
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>
    <title>Arquivar</title>
</head>

<body>
    <form method="post">
        <label for="codigoLivro">Código do Livro:</label>
        <input type="number" name="codigoLivro" id="codigoLivro" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php
    if (isset($_POST['buscar'])) {
        $codigoLivro = $_POST['codigoLivro'];

        // Consultar o livro
        $sql = "SELECT id_livro, nome_livro, arquivar_livro FROM livro WHERE id_livro = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $codigoLivro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $livro = $result->fetch_assoc();
    ?>
            <form action="arquiva_livro.php" method="post">
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
                        <td>
                            <?php 
                            if (isset($livro["arquivar_livro"])) {
                                echo $livro["arquivar_livro"] == 1 ? "Sim" : "Não"; 
                            } else {
                                echo "Não disponível";
                            }
                            ?>
                        </td>
                    </tr>
                </table>

                <?php
                if (isset($livro["arquivar_livro"]) && $livro["arquivar_livro"] == 1) {
                    echo "<input type='hidden' name='motivo_arq' id='motivo_arq' value='null'>";
                } else {
                    echo "Motivo do arquivamento: </p>";
                    echo "<textarea name='motivo_arq' id='motivo_arq' cols='30' rows='10' style='resize: none;' required></textarea></p>";
                }
                ?>
                
                <input type="hidden" name="codigoLivro" value="<?php echo htmlspecialchars($livro['id_livro']); ?>">
                <input type="hidden" name="arquivar_livro" value="<?php echo htmlspecialchars($livro['arquivar_livro']); ?>">

                <?php 
                if (isset($livro["arquivar_livro"]) && $livro["arquivar_livro"] == 1) {
                    echo "<input type='submit' name='arquivar' value='Ativar'>";
                } else {
                    echo "<input type='submit' name='arquivar' value='Arquivar'>";
                } 
                ?>
            </form>

    <?php
        } else {
            echo "Livro não encontrado.";
        }

        $stmt->close();
        $con->close();
    }
    ?>

    
</body>

</html>
