<?php
session_start();
include('./verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Anotações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
        }
        .anotacoes {
            list-style: none;
            padding: 0;
            margin: 20px auto;
            width: 60%;
        }
        .anotacao-item {
            margin: 10px 0;
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .anotacao-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .anotacao-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

    <h2>Listar Anotações</h2>

    <ul class="anotacoes">
        <li class="anotacao-item">
            <a href="exibir_anotacao.php?id=1">Anotação 1: Título Exemplo</a>
        </li>
        <li class="anotacao-item">
            <a href="exibir_anotacao.php?id=2">Anotação 2: Título Exemplo</a>
        </li>
        <li class="anotacao-item">
            <a href="exibir_anotacao.php?id=3">Anotação 3: Título Exemplo</a>
        </li>
        <li class="anotacao-item">
            <a href="exibir_anotacao.php?id=4">Anotação 4: Título Exemplo</a>
        </li>
    </ul>
</body>
</html>
