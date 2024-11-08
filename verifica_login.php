<?php
session_start();

include('includes/db.php');

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

 
 