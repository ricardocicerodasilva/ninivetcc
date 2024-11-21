<?php   


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
   <link rel="stylesheet" href="style/fundo.css">  
  
</head>
<body>
<div class="perfil-container">
    <div class="foto">
        <a href="alterar_perfil.php">
 <?php   
$login = $_SESSION['login'] ?? null;
// Consulta a imagem de perfil do banco de dados
$sql = "SELECT foto_perfil FROM bibliotecario WHERE login = '$login'";
$result = mysqli_query($con, $sql);

// Define o caminho da imagem de perfil ou uma imagem padrão, caso não exista
$login = $_SESSION['login'] ?? null;
$sql = "SELECT foto_perfil FROM bibliotecario WHERE login = '$login'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $foto_perfil = !empty($userData['foto_perfil']) ? $userData['foto_perfil'] : 'assets/perfil/default.jpg';
} else {
    $foto_perfil = 'assets/perfil/default.jpg';
}
?>
     <img src="<?php echo $foto_perfil . '?' . time(); ?>" alt="Imagem de Perfil">
        </a>
        <p><?php echo $_SESSION['login']; ?></p>
    </div>

    <a href="logout.php" class="botao-sair">Sair</a>
</div>


<div class="overlay"></div>
<div class="menu-container">
    <div class="menu-toggle" id="menu-toggle">
        <div class="bar bar1"></div>
        <div class="bar bar2"></div>
        <div class="bar bar3"></div>
    </div>
    <nav class="nav-menu">
        <ul>
            <li>
                <a href="gerenciar_livro.php">Gerenciar livros</a>
                
            </li>
            <li>
                <a href="gerenciar_alunos.php">Gerenciar alunos</a>
              
            </li>
            <li>
                <a href="gerenciar_acervo.php">Acervo</a>
                
            </li>
            <li>
                <a href="notificacoes.php">Notificações</a>
                
                   
                 </li>
            <li>
                <a href="gerenciar_relatorio.php">Relatório</a>
               
            </li>
            <li>
                <a href="gerenciar_anotacoes.php">Anotações</a>
                
                 </li>
            <li>
                <a href="gerenciar_suporte">Suporte / FAQ</a>         
                   

                 </li>
            <li>
                 <a href="cadastrar_usuario.php">Cadastro usuário</a>
                  </li>
        </div>
<body>
<a href="home.php">
<img class="img" src="assets/ninive.png" alt="Descrição da Imagem">
</a>
<script src="script/script.js"></script>
</body>
</html>