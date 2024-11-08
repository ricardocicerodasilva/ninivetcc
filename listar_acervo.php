<?php

include('verifica_login.php');
include ('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listar livros</title>
    <meta charset="utf-8">
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #d7d7d7;
            margin: 0;
            padding: 0;
            color:bold;
          /*  background-image: url('assets/imgcadastro.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: auto;*/
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
 
$sql = "SELECT * FROM livro ";
$result = $con->query($sql);
 
if ($result->num_rows > 0) {
    echo "<center><table border='1'>
            <tr>
                <th>ID</th>
                <th>Data do Cadastro</th>
                <th>Livro Arquivado</th>
                <th>Motivo do Arquivamento</th>
                <th>CDD</th>
                <th>Cutter</th>
                <th>Autor</th>
                <th>Nome do Livro</th>
                <th>Subtítulo</th>
                <th>Série/Coletânea</th>
                <th>Edição</th>
                <th>Volume</th>
                <th>Local</th>
                <th>Editora</th>
                <th>Data de Publicação</th>
                <th>Aquisição</th>
                <th>Exemplar</th>
                <th>Língua</th>
                <th>Observação</th>
                <th>Capa</th>
            </tr>";
 
    // Exibindo cada linha de dados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <th>" . $row["id_livro"] . "</th>
                <th>" . $row["data_cadastro"] . "</th>";
 
                if ($row["arquivar_livro"] == 1) {
                    echo "<th>Sim</th>";
                } else {
                    echo "<th>Não</th>";
                }
 
        echo   "<th>" . $row["motivo_arq"] . "</th>
                <th>" . $row["cdd"] . "</th>
                <th>" . $row["cutter"] . "</th>
                <th>" . $row["autor"] . "</th>
                <th>" . $row["nome_livro"] . "</th>
                <th>" . $row["subtitulo"] . "</th>
                <th>" . $row["serie_colecao"] . "</th>
                <th>" . $row["edicao"] . "</th>
                <th>" . $row["volume"] . "</th>
                <th>" . $row["local"] . "</th>
                <th>" . $row["editor"] . "</th>
                <th>" . $row["data_publicacao"] . "</th>
                <th>" . $row["aquisicao"] . "</th>
                <th>" . $row["exemplar"] . "</th>
                <th>" . $row["lingua"] . "</th>
                <th>" . $row["observacao"] . "</th>
                <th><img src='" . $row['capa_livro'] . "' width='50' height='50'></th>
              </tr>";
    }
    echo "</table></center>";
}
 else {
    echo "Nenhum resultado encontrado.";
}
 
$con->close();
?>


</body>
</html>
