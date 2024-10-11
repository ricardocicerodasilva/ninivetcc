<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Evento</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

form {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

fieldset {
    border: none;
    margin: 0;
    padding: 0;
}

legend {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="number"] {
    width: calc(100% - 150px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    margin-bottom: 10px;
}

input[type="image"] {
    border: none;
    background-color: transparent;
    cursor: pointer;
}

center {
    margin-top: 20px;
}

h3 {
    margin-top: 20px;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

<?php
        $cod = $_POST['tCodigo'];
       
        $host="localhost:3306";
        $use = "root";
        $pass ="";
        $base ="agenda_compromissos";
        $con =mysqli_connect($host,$use,$pass,$base);
 
        $res=mysqli_query($con,"DELETE FROM agenda WHERE id_compromisso = $cod;");
    echo "Evento removido com sucesso";
    echo "</br></br>";
    mysqli_close($con);
     echo "<center><h3><a href='deletar.php'>Voltar para a página anterior</a></h3></center>";

    
    
    ?>
</body>
</html>