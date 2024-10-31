<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Acervo</title>
    <style>
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

        .formulario {
            display: grid;
            gap: 20px;
            max-width: 800px;
            margin: auto;
        }

        .notifications {
            list-style: none;
            padding: 0;
        }

        .notification-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
           
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

    <h2>Criar Relatório de Empréstimos</h2>

    <div class="form-container">
        <form action="#" method="post" class="formulario">
            <div class="form-group">
                <label for="name">Digite o mês:</label>
                <input type="date" id="data" name="data" placeholder="digite a data" required>
            </div>
            
            <br>
            <div class="form-group">
                <label for="message">Relatório:</label>
                <textarea id="message" name="message" placeholder="" required></textarea>
            </div>
            <div class="form-group">
                <label for="name">Digite o nome do relatório:</label>
                <input type="text" id="name" name="name" placeholder="" required>
            </div>
            <div class="button-container">
                <input type="submit" value="Gerar">
                <input type="submit" value="Salvar">
            </div>
        </form>
    </div>
</body>
</html>
