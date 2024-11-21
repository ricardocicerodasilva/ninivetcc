<?php   
include('verifica_login.php');
include('includes/db.php');
include('includes/fundo.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genciamento</title>
    <!-- Inclusão do arquivo CSS externo -->
    <link rel="stylesheet" href="style/gerenciar.css"> 
 
</head>
<body>
 

<div class="container">
        <div class="caixa">
            <a href="cadastrar_aluno.php">
                <img src="assets/imagens/aluno.png" alt="Cadastrar">
                <p>Cadastrar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="atualizar_aluno.php">
                <img src="assets/imagens/atualizar.png" alt="Atualizar">
                <p>Atualizar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="buscar_aluno.php">
                <img src="assets/imagens/buscaraluno.png" alt="Buscar">
                <p>Buscar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="bloquear_aluno.php">
                <img src="assets/imagens/bloquear.png" alt="Arquivar">
                <p>Bloquear</p>
            </a>
        </div>
    </div>
</body>
</html>
