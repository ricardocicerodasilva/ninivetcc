<html>
    <body>

    </body>
</html>


<?php


$host = "localhost";
$port = "3306";
$user = "root";
$pass = "";
$base = "academia_bigbang";
$con = mysqli_connect("$host:$port", $user, $pass, $base);

$nome= $_POST['nome'];
$telefone= $_POST['telefone'];
$email= $_POST['email'];
$endereco=$_POST['endereco'];
$complemento=$_POST['complemento'];
$cep = $_POST['cep'];
$cidade=$_POST['cidade'];
$opcao=$_POST['atividade'];




$sql = "INSERT INTO academia (nome,telefone, email,endereco,complemento, cep, cidade,atividades) 
        VALUES ('$nome', '$telefone', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$opcao')";


if ($con->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar o evento: " . $con->error;
}
$con->close();
?>
<center><h3><a href='index.php'>Voltar para a página inicial</a></h3></center>