<?php
include('verifica_login.php');
$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "etecguaru01";
$con   = mysqli_connect($host, $user, $pass, $base);

if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Verificar se os dados foram enviados via POST
$num_reserva = isset($_POST['num_reserva']) ? $_POST['num_reserva'] : '';
$rm_aluno = isset($_POST['rm_aluno']) ? $_POST['rm_aluno'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Reserva</title>
</head>
<body>
    <form method="post">
        <label for="rm_aluno">Anotação</label>
        <input type="hidden" name="num_reserva" id="num_reserva" value="<?php echo htmlspecialchars($num_reserva); ?>" required>
        <input type="hidden" name="rm_aluno" id="rm_aluno" value="<?php echo htmlspecialchars($rm_aluno); ?>" required>
        <input type="text" name="anotacao" id="anotacao" required>
        <input type="submit" name="confirmar" value="Confirmar">
    </form>

    <?php
    // Processamento do formulário após submissão
    if (isset($_POST['confirmar'])) {
        $anotacao = $_POST['anotacao'];
        $num_reserva = $_POST['num_reserva'];
        $rm_aluno = $_POST['rm_aluno'];

        // Verificação se o rm_aluno existe na tabela aluno
        $verificaAluno = "SELECT * FROM aluno WHERE rm_aluno = '$rm_aluno'";
        $resultadoAluno = $con->query($verificaAluno);

        if ($resultadoAluno && $resultadoAluno->num_rows > 0) {
            // Inserção no banco de dados
            $sql = "INSERT INTO confirma_reserva (confirmar_reserva, confirmar_devolucao, livro_disponivel, anotacao, num_reserva, rm_aluno)  
                    VALUES (1, 0, 0, '$anotacao', '$num_reserva', '$rm_aluno')";

            if ($con->query($sql) === TRUE) {
                echo "Confirmação realizada com sucesso!";
                header("Location: confirma_reserva.php"); // Redireciona para evitar resubmissão
                exit();
            } else {
                echo "Erro ao confirmar o livro: " . $con->error;
            }
        } else {
            echo "Erro: O RM do aluno não existe.";
        }
    }

    $con->close();
    ?>
</body>
</html>
