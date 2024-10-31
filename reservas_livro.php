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
<center> <h2>Reservas</h2></center>
<?php
// Consulta para buscar reservas e o nome do livro associado
$sql = "
    SELECT reserva.num_reserva, reserva.data_reserva, reserva.data_devolucao, reserva.rm_aluno, livro.nome_livro
    FROM reserva
    JOIN livro ON reserva.id_livro = livro.id_livro
";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<center>
            <table border='1' style='border-top: 4px solid red; width: 80%; border-collapse: collapse; margin-top: 20px;'>
                <thead>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 10px; border: 1px solid #ddd;'>ID</th>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Data de Reserva</th>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Data de Devolução</th>
                        <th style='padding: 10px; border: 1px solid #ddd;'>RM do aluno</th>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Nome do livro</th>
                    </tr>
                </thead>
                <tbody>";
    
    // Exibindo cada linha de dados
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='text-align: center;'>
                <td style='padding: 10px; border: 1px solid #ddd;'>" . $row["num_reserva"] . "</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>" . $row["data_reserva"] . "</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>" . $row["data_devolucao"] . "</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>" . $row["rm_aluno"] . "</td>
                <td style='padding: 10px; border: 1px solid #ddd;'>" . $row["nome_livro"] . "</td>
              </tr>";
    }

    echo "</tbody></table></center>";
} else {
    echo "<center><p>Nenhum resultado encontrado.</p></center>";
}

// Fecha a conexão com o banco de dados
$con->close();
?>

