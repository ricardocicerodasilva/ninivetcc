<!DOCTYPE html>
<html>
<head>
    <title>Eventos Registrados</title>
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
            background-color: #007bff;
            color: white;
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
   <center> <h2>Eventos Registrados</h2></center>
    <?php
        $host = "localhost";
        $port = "3306";
        $user = "root";
        $pass = "";
        $base = "academia_bigbang";
        $con = mysqli_connect("$host:$port", $user, $pass, $base);
        $res = mysqli_query($con,"select * from academia");
        echo "<table><tr><th>Id do Evento</th><th>Nome </th><th>telefone</th><th>email</th><th>endereco</th><th>complemento</th><th>cep</th><th>cidade</th> <th>Atividades</th></tr>";
        while($escrever=mysqli_fetch_array($res)){
            echo "<tr><td>".$escrever['id_compromisso']."</td><td>".$escrever['nome']."</td><td>".$escrever['telefone']."</td><td>".$escrever['email']."</td><td>".$escrever['endereco']."</td><td>".$escrever['complemento']."</td><td>".$escrever['cep']."</td><td>".$escrever['cidade']."</td><td>".$escrever['atividades']."</td></tr>";
        }
        echo "</table>";
        mysqli_close($con);
    ?>
    <center><h3><a href='index.php'>Voltar para a página inicial</a></h3></center>
</body>
</html>
