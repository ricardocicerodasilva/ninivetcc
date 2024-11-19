<?php   
//include('verifica_login.php');
include('includes/db.php');
include('includes/fundo.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Genciamento</title>
    <style>
a{
    background-color: yellow; /* Cor de fundo */
height: 90px;
width:200px;
font-size: 20px;
color: black; /* Cor da fonte */
font-weight: bold; /* Fonte em negrito */
 display: inline-block;;
align-items: center;
justify-content: center; /* Centraliza o texto no item */
position: absolute;
margin: 0 auto;
margin-top: 400px;
}
.caixa {
            color: black;
            font-size: 20px;
            width: 250px; /* Ajuste o tamanho conforme necessário */
            height: 150px; /* Permite que a altura se ajuste ao conteúdo */
            text-align:center; /* Alinha o texto à esquerda dentro da caixa */
            border: 2px solid #000; /* Adiciona uma borda preta ao redor da caixa */
            padding: 10px; /* Adiciona um espaço interno ao redor do texto */
            box-sizing: border-box; /* Inclui o padding e a borda na largura total da caixa */
            margin-bottom:5px; /* Espaçamento abaixo de cada caixa */
            display: inline-block; /* Faz com que as caixas fiquem lado a lado */
            margin: 0 auto; /* Espaçamento entre as caixas */
            margin-top: 400px;
        }
    </style>
  
</head>
<body>
    <div class="container">
<h4 class="caixa"> <a href="cadastrar_livro.php">Cadastrar</a>
<h4 class="caixa"> <a href="atualizar_livro.php">Atualizar</a>
<h4 class="caixa"> <a href="buscar_livro.php">Buscar</a>
<h4 class="caixa"> <a href="arquivar_livro.php">Atualizar</a>
    </div>
</body>
</html>