<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar livro </title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4 url('assets/imgcadastro.jpg') no-repeat center center / cover;
        }

        /* Logo */
        .image {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
        }

        /* Título */
        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        /* Estilos de formulário */
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

        input[type="number"],
        input[type="text"],
        textarea {
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

        /* Tabela */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
        }

        th {
            background-color: #0a6789;
            color: #fff;
            font-weight: bold;
        }

        /* Caixa de texto ajustável */
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
            
            fetch('reserva_livro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert("Reserva realizada com sucesso");
                event.target.reset();
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>


<form onsubmit="reservaLivro(event)">

        <label for="idLivro">ID do livro</label>
        <input type="text" name="idLivro" id="idLivro" required></p>

        <label for="rmAluno">RM do Aluno(a):</label>
        <input type="text" name="rmAluno" id="rmAluno" required></p>

        <label for="dataReserva">Data da reserva:</label>
        <input type="date" name="dataReserva" id="dataReserva" required></p>

        <label for="dataDevolucao">Data de devolução:</label>
        <input type="date" name="dataDevolucao" id="dataDevolucao" ></p>

        <input type="submit" value="Reservar">
    </form>


    <script>
    /*    // Função para formatar a data no formato YYYY-MM-DD
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Mês começa em 0
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        const today = new Date();

        // Define o min da data de reserva como a data atual
        document.getElementById("dataReserva").setAttribute("min", formatDate(today));

        // Adiciona um listener ao campo de reserva
        document.getElementById("dataReserva").addEventListener("input", function() {
            const selectedDate = new Date(this.value);
            const minDevolucao = new Date(selectedDate);
            const maxDevolucao = new Date(selectedDate);

            // Define a data mínima como a data da reserva
            minDevolucao.setDate(selectedDate.getDate());
            // Define a data máxima como um mês a partir da data da reserva
            maxDevolucao.setMonth(selectedDate.getMonth() + 1);

            // Atualiza os atributos min e max do campo de devolução
            document.getElementById("dataDevolucao").setAttribute("min", formatDate(minDevolucao));
            document.getElementById("dataDevolucao").setAttribute("max", formatDate(maxDevolucao));

            // Habilita o campo de devolução
            document.getElementById("dataDevolucao").disabled = false;
        });*/
    </script>
</body>

</html>
