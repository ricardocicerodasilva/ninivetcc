<?php
include('verifica_login.php');

$host = "localhost";
$user = "root";
$pass = "";
$base = "etecguaru01";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

if (mysqli_connect_errno()) {
    echo json_encode(['error' => 'Falha na conexão com o banco de dados: ' . mysqli_connect_error()]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rm'])) {
    $rm = $_POST['rm'];

    // Validação do RM (exemplo simples)
    if (empty($rm)) {
        echo json_encode(['error' => 'RM não pode estar vazio.']);
        exit();
    }

    // Consulta ao banco de dados
    $stmt = $con->prepare("SELECT * FROM alunos WHERE rm = ?");
    
    if (!$stmt) {
        echo json_encode(['error' => 'Erro ao preparar a consulta: ' . $con->error]);
        exit();
    }
    
    $stmt->bind_param("s", $rm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $aluno = $result->fetch_assoc();
        
        if ($aluno) {
            echo json_encode($aluno);
        } else {
            echo json_encode(['error' => 'Aluno não encontrado.']);
        }
    } else {
        echo json_encode(['error' => 'Erro na execução da consulta: ' . $stmt->error]);
    }

    $stmt->close();
}
$con->close();
?>
