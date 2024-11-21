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
            <a href="listar_acervo.php">
                <img src="assets/imagens/aluno.png" alt="Listar">
                <p>Listar Acervo</p>
            </a>
        </div>
        <div class="caixa">
            <a href="reservar_livro.php">
                <img src="assets/imagens/atualizar.png" alt="Reservar">
                <p>Reservar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="reservas_livro.php">
                <img src="assets/imagens/buscaraluno.png" alt="reservas">
                <p>Reservas</p>
            </a>
        </div>
        
    </div>
</body>
</html>
