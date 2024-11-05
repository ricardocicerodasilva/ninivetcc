
<?php
include('verifica_login.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_reserva = $_POST['num_reserva'];

    // Atualiza confirmar_reserva para true
    $sql_update = "UPDATE confirma_reserva SET confirmar_devolucao = true, livro_disponivel = true WHERE num_reserva = '$num_reserva'";

    if ($con->query($sql_update) === TRUE) {
        echo "Reserva confirmada com sucesso!";
    } else {
        echo "Erro ao confirmar reserva: " . $con->error;
    }

    // Redireciona de volta para a página de reservas
    header("Location: confirmarReserva.php"); // Altere para o nome correto da página
    exit();
}

$con->close();
?>
