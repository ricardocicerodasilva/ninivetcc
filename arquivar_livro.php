<?php
include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <center>
        <h3><a href='home.php'>Voltar para a página inicial</a></h3>
    </center>
</body>

</html>
