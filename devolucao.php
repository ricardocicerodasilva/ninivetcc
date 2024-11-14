<?php
include('verifica_login.php');
include('includes/db.php');

// Verifica se o parâmetro 'id_reserva' foi passado
if (isset($_GET['id_reserva'])) {
    $id_reserva = $_GET['id_reserva'];

    // Atualiza o status da reserva para devolvido
    $sql = "UPDATE reserva SET status = 'devolvido' WHERE num_reserva = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_reserva);

    if ($stmt->execute()) {
        echo "<script>alert('Devolução registrada com sucesso!'); window.location.href='reservas_livro.php';</script>";
    } else {
        echo "<script>alert('Erro ao registrar devolução.'); window.location.href='reservas_livro.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID de reserva não fornecido.'); window.location.href='reservas_livro.php';</script>";
}

$con->close();
?>
