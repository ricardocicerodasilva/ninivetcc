<!DOCTYPE html>
<html>
<head>
    <title>Listar livros</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f7114b;
            color: black;
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
        h3 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
   <center> <h2>Acervo</h2></center>
    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $base = "bd_login";
        $con = mysqli_connect($host, $user, $pass, $base);
        $res = mysqli_query($con,"select * from LIVRO");
        echo "<table><tr><th>Codígo Livro</th><th>Nome do Livro</th><th>Autor</th><th>Gênero</th><th>Edição</th><th>Editora</th>
        <th>Data de Publicação</th><th>Quantidade</th><th>Descrição</th><th>Arquivado</th><th>Motivo arquivamennto</th></tr>";

        while($escrever=mysqli_fetch_array($res)){
            echo "<tr><td>".$escrever['id_livro']."</td><td>".$escrever['nome_livro']."</td>
            <td>".$escrever['autor']."</td><td>".$escrever['genero']."</td><td>".$escrever['edicao']."</td>
            <td>".$escrever['editora']."</td><td>".$escrever['data_publi']."</td><td>".$escrever['quantidade']."</td>
            <td>".$escrever['descricao']."</td><td>".$escrever['arquivar_livro']."</td><td>".$escrever['motivo_arq']."</td></tr>";
        }
        echo "</table>";
        mysqli_close($con);
    ?>
    <center><h3><a href='home.php'>Voltar para a página inicial</a></h3></center>
</body>
</html>
