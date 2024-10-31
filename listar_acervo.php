<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listar livros</title>
    <meta charset="utf-8">
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
            width: 100px;1
            height: auto;
            z-index: 1000;
        }
        table {
            width: 90%;
            margin: 20px auto;
           border-collapse: collapse;
          border: 3px solid black;
        margin-top:70px;
            
        }
        th, td {
            padding: 8px;
            text-align: center;
          border-bottom: 2px solid black;*/
            border: 1px solid black;
            font-size:16px;
        }
        th {
            background-color:#0a6789;
            color: white;
            gap:20px;
            
        }
        tr:hover {
            background-color: #f2f2f2w;
            
            
            
        }
        a {
            color: #f2f2f2w;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
            font-size:50px;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>
   <center> <h2>Acervo</h2></center>
    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $base = "etecguaru01";
        $con = mysqli_connect($host, $user, $pass, $base);
        $res = mysqli_query($con,"select * from LIVRO");
        echo "<table><tr><th>Codígo Livro</th><th>Nome do Livro</th><th>Autor</th><th>Gênero</th><th>Edição</th><th>Editora</th>
        <th>Data de Publicação</th><th>Quantidade</th><th>Descrição</th><th>Arquivado</th><th>Motivo arquivamennto</th></tr>";

        while($escrever=mysqli_fetch_array($res)){
            echo "<tr><td>".$escrever['id_livro']."</td><td>".$escrever['nome_livro']."</td>
            <td>".$escrever['autor']."</td><td>".$escrever['genero']."</td><td>".$escrever['edicao']."</td>
            <td>".$escrever['editora']."</td><td>".$escrever['data_publicacao']."</td><td>".$escrever['quantidade']."</td>
            <td>".$escrever['descricao']."</td><td>".$escrever['arquivar_livro']."</td><td>".$escrever['motivo_arq']."</td></tr>";
        }
        echo "</table>";
        mysqli_close($con);
    ?>
</body>
</html>
