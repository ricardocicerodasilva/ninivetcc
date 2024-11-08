<?php
include('verifica_login.php');
include('includes/db.php');
$num_reserva = $_POST['num_reserva'];
$rm_aluno = $_POST['rm_aluno'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <label for="rm_aluno">Anotação</label>
        <input type="hidden" name="num_reserva" id="num_reserva" value= "<?php echo $num_reserva ?>" required>
        <input type="hidden" name="rm_aluno" id="rm_aluno" value= "<?php echo $rm_aluno ?>" required>
        <input type="text" name="anotacao" id="anotacao" required>
        <input type="submit" name="confirmar" value="confirmar">
    </form>

    <?php
    if (isset($_POST['confirmar'])) {
        $anotacao = $_POST['anotacao'];
        $num_reserva = $_POST['num_reserva'];
        $rm_aluno = $_POST['rm_aluno'];

        $sql = "INSERT INTO confirma_reserva (confirmar_reserva, confirmar_devolucao, livro_disponivel, anotacao, num_reserva, rm_aluno)  
        VALUES (true, false, false, '$anotacao',  $num_reserva, $rm_aluno)";


        if ($con->query($sql) === TRUE) {
            echo "Confirmação realizado com sucesso!";
            header("Location: confirmarReserva.php"); 
            exit();
        } else {
            echo "Erro ao Confirmação o Livro: " . $con->error;
        }
    }
    $con->close();
    ?>
</body>

</html>