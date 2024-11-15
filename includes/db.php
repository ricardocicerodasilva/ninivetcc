
<?php
// includes/db.php
$servername = "SRVDS";
$username = "ninivebiblio-user";
$password = "ninivebiblio2024";
$dbname = "db_ninivebiblio";

// Ativar relatório de erros
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Criar conexão
$con = new mysqli($servername, $username, $password, $dbname);

// Definir o conjunto de caracteres
$con->set_charset("utf8");

// Verificar a conexão
if ($con->connect_error) {
    die("Conexão falhou: " . $con->connect_error);
} else {
    // Echoing successful connection can be useful for debugging, but remove it in production
    // echo "Conexão bem-sucedida!";
}
?>
