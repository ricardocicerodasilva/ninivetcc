<?php
include('verifica_login.php');  // Verifica o login do usuário
include('includes/db.php');      // Conecta ao banco de dados

// Função para processar a reserva
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeLivro = $_POST['nomeLivro'];
    $rmAluno = $_POST['rmAluno'];
    $dataReserva = $_POST['dataReserva'];
    $dataDevolucao = $_POST['dataDevolucao'];

    // Verifica se o aluno já tem uma reserva ativa
    $sqlVerificaReserva = "SELECT * FROM reserva WHERE rm_aluno = ? AND status = 'ativo'";
    $stmtVerifica = $con->prepare($sqlVerificaReserva);
    $stmtVerifica->bind_param("s", $rmAluno);
    $stmtVerifica->execute();
    $stmtVerifica->store_result();
    
    if ($stmtVerifica->num_rows > 0) {
        echo "Você já tem uma reserva ativa. Por favor, devolva o livro antes de fazer uma nova reserva.";
        exit;
    }

    // Verificando a disponibilidade do livro
    $sqlLivro = "SELECT id_livro FROM livro WHERE nome_livro = ? AND status = 'disponivel' LIMIT 1";
    $stmtLivro = $con->prepare($sqlLivro);
    $stmtLivro->bind_param("s", $nomeLivro);
    $stmtLivro->execute();
    $stmtLivro->store_result();
    
    if ($stmtLivro->num_rows > 0) {
        $stmtLivro->bind_result($idLivro);
        $stmtLivro->fetch();

        // Inserir a reserva no banco de dados
        $sqlReserva = "INSERT INTO reserva (id_livro, rm_aluno, data_reserva, data_devolucao, status) VALUES (?, ?, ?, ?, 'ativo')";
        $stmtReserva = $con->prepare($sqlReserva);
        $stmtReserva->bind_param("isss", $idLivro, $rmAluno, $dataReserva, $dataDevolucao);

        if ($stmtReserva->execute()) {
            // Atualiza o status do livro para 'reservado'
            $sqlAtualizaLivro = "UPDATE livro SET status = 'reservado' WHERE id_livro = ?";
            $stmtAtualizaLivro = $con->prepare($sqlAtualizaLivro);
            $stmtAtualizaLivro->bind_param("i", $idLivro);
            $stmtAtualizaLivro->execute();
            echo "Reserva realizada com sucesso!";
        } else {
            echo "Erro ao realizar a reserva.";
        }
    } else {
        echo "Este livro não está disponível no momento.";
    }

    // Fechar conexões
    $stmtLivro->close();
    $stmtReserva->close();
    $con->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Livro</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4 url('assets/imgcadastro.jpg') no-repeat center center / cover;
        }

        .image {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        label {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        input[type="text"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #0a6789;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005f77;
        }

        textarea {
            resize: none;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<h2>Reservar Livro</h2>

<script>
    function reservaLivro(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        fetch('reservar_livro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);  // Exibe a resposta (sucesso ou erro)
            event.target.reset();  // Limpa o formulário após a reserva
        })
        .catch(error => {
            console.error('Erro:', error);
            alert("Erro ao realizar a reserva.");
        });
    }

    // Função para formatar a data no formato YYYY-MM-DD
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');  // Mês começa em 0
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

        // Habilita o campo de devolução
        document.getElementById("dataDevolucao").disabled = false;
    });
</script>

<form onsubmit="reservaLivro(event)">
    <label for="nomeLivro">Título do livro</label>
    <input type="text" name="nomeLivro" id="nomeLivro" required oninput="buscarLivro()">

    <label for="rmAluno">RM do Aluno(a):</label>
    <input type="text" name="rmAluno" id="rmAluno" required>

    <label for="dataReserva">Data da reserva:</label>
    <input type="date" name="dataReserva" id="dataReserva" required>

    <label for="dataDevolucao">Data de devolução:</label>
    <input type="date" name="dataDevolucao" id="dataDevolucao" disabled required>

    <input type="submit" value="Reservar">
</form>

<script>
    // Função para buscar o livro e verificar a disponibilidade
    function buscarLivro() {
    const nomeLivro = document.getElementById("nomeLivro").value;

    if (nomeLivro.trim() === "") {
        alert("Por favor, digite o título do livro.");
        return;
    }

    // Requisição para o PHP de buscar o livro
    fetch('busc_livro.php', {
        method: 'POST',
        body: new URLSearchParams({ nomeLivro: nomeLivro })
    })
    .then(response => response.json())  // Espera a resposta como JSON
    .then(data => {
        if (data.disponivel === true) {
            alert("O livro está disponível para reserva.");
        } else {
            alert("Este livro não está disponível no momento.");
        }
    })
    .catch(error => {
        console.error('Erro ao buscar livro:', error);
        alert("Erro ao verificar a disponibilidade do livro.");
    });
}

</script>

</body>
</html>
