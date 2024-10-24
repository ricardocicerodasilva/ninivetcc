<html>
    <body>
    </body>
</html>

<?php

$host = "localhost";
$user = "root";
$pass = "";
$base = "bd_login";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Verificando se o campo de busca foi enviado
if (isset($_POST['rm'])) {
    $rm = $_POST['rm'];

    // Comando SELECT para buscar os dados do aluno com base no RM
    $sql = "SELECT * FROM aluno WHERE rm_aluno = '$rm'";
    
    // Executando a consulta
    $result = $con->query($sql);

    // Verificando se houve algum resultado
    if ($result->num_rows > 0) {
        // Exibindo os dados do aluno
        while($row = $result->fetch_assoc()) {
            echo "RM: " . $row["rm_aluno"] . "<br>";
            echo "Nome: " . $row["nome_aluno"] . "<br>";
            echo "Email: " . $row["email"] . "<br>";
            echo "Telefone: " . $row["telefone"] . "<br>";
            echo "Período: " . $row["periodo"] . "<br>";
            echo "<br>";
        }
    } else {
        echo "Nenhum aluno encontrado com esse RM.";
    }
} else {
    echo "Por favor, insira o RM do aluno para buscar.";
}

$con->close();
?>

<center><h3><a href='home.php'>Voltar para a página inicial</a></h3></center>
