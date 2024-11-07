<?php
session_start();

$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "etecguaru01";

$con = mysqli_connect($host, $user, $pass, $base);

if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); 
    exit();
}

$id_bibli = $_SESSION['login'];
$foto_perfil = $_SESSION['foto_perfil'];

?>

 
 