<?php
include('verifica_login.php');  // Verifica o login do usuário
include('includes/db.php');      // Conecta ao banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <style>
        /* Seu estilo CSS */
    </style>
</head>

<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<form action="reserva_livro.php" method="POST">
    <label for="nomeLivro">Nome do Livro:</label>
    <input type="text" name="nomeLivro" required>

    <label for="rmAluno">RM do Aluno:</label>
    <input type="text" name="rmAluno" required>

    <label for="dataReserva">Data da Reserva:</label>
    <input type="date" name="dataReserva" id="dataReserva" required>

    <label for="dataDevolucao">Data de Devolução:</label>
    <input type="date" name="dataDevolucao" id="dataDevolucao" required>

    <button type="submit" name="btn-reservar">Reservar</button>
</form>
    
<script>
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    const today = new Date();
    document.getElementById("dataReserva").setAttribute("min", formatDate(today));

    document.getElementById("dataReserva").addEventListener("input", function() {
        const selectedDate = new Date(this.value);
        const minDevolucao = new Date(selectedDate);
        const maxDevolucao = new Date(selectedDate);
        
        minDevolucao.setDate(selectedDate.getDate());
        maxDevolucao.setMonth(selectedDate.getMonth() + 1);

        document.getElementById("dataDevolucao").setAttribute("min", formatDate(minDevolucao));
        document.getElementById("dataDevolucao").setAttribute("max", formatDate(maxDevolucao));
        document.getElementById("dataDevolucao").disabled = false;
    });
</script>
</body>
</html>
