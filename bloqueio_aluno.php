<?php

include('verifica_login.php');


$host = "localhost";
$user = "root";
$pass = "";
$base = "etecguaru01";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

if (isset($_POST['bloquear'])) {
    $rm_aluno = mysqli_real_escape_string($con, $_POST['rm_aluno']);
    $bloqueado = mysqli_real_escape_string($con, $_POST['bloqueado']);
    $motivo_bloq = mysqli_real_escape_string($con, $_POST['motivo_bloq']);

    // Prepare a query com valores diretos
    if ($bloqueado == 1) { // Desbloquear
        $sql = "UPDATE aluno SET bloqueado = 0, motivo_bloq = '$motivo_bloq' WHERE rm_aluno = $rm_aluno";
        echo "Aluno Desbloqueado com sucesso!";
    } else { // Bloquear
        $sql = "UPDATE aluno SET bloqueado = 1, motivo_bloq = '$motivo_bloq' WHERE rm_aluno = $rm_aluno";
        echo "Aluno Bloqueado com sucesso!";
    }

    // Executar a consulta
    if ($con->query($sql) === TRUE) {
        // Mensagem de sucesso já está dentro da condição anterior
    } else {
        echo "Erro ao atualizar o status do Aluno: " . $con->error;
    }
}
?>
<center>
<h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
