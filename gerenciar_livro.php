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
            <a href="cadastrar_livro.php">
                <img src="assets/imagens/cadastrar.png" alt="Cadastrar">
                <p>Cadastrar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="atualizar_livro.php">
                <img src="assets/imagens/atualizar.png" alt="Atualizar">
                <p>Atualizar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="buscar.php">
                <img src="assets/imagens/buscar.png" alt="Buscar">
                <p>Buscar</p>
            </a>
        </div>
        <div class="caixa">
            <a href="arquivar_livro.php">
                <img src="assets/imagens/arquivar.png" alt="Arquivar">
                <p>Arquivar</p>
            </a>
        </div>
    </div>
</body>
</html>
