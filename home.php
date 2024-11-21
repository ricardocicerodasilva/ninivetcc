<?php   
include('verifica_login.php');
include('includes/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NINIVE</title>
    <link rel="stylesheet" href="style/styles.css"> 
    
  
</head>
<body>
<div class= "perfil">
    <a href='logout.php' class="botao-sair">Sair</a>
</div>
<div class="foto">
    <a href='alterar_perfil.php'>
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
   <img src="<?php echo $foto_perfil . '?' . time(); ?>" width="50px" height="50px" alt="Imagem de Perfil">
    </a>
    <p><?php echo $_SESSION['login']; ?></p> <!-- Exibe o nome do usuário -->
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
                
                   
                </ul>
            </li>
            <li>
                <a href="#">Relatório</a>
                <ul class="submenu">
                    <li><a href="relatorio.php">Gerar relatório</a></li><br>
                    <li><a href="visualizar_relatorio.php">Visualizar relatórios</a></li><br>
                </ul>
            </li>
            <li>
                <a href="#">Anotações</a>
                <ul class="submenu">
                    <li><a href="adicionar_anotacoes.php">Adicionar anotações</a></li><br>
                    <li><a href="listar_anotacoes.php">Listar anotações</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Suporte / FAQ</a>
                <ul class="submenu">
                    <li><a href="faq.php">FAQ</a></li><br>
                    <li><a href="#contactForm">Suporte técnico</a></li>

                </ul>
            </li>
            <li>
                 <a href="cadastrar_usuario.php">Cadastro usuário</a>
                </ul>
            </li>
        </ul>
    </nav>
</div>



<div class="slideshow-container">
        <div class="mySlides" style="background-image: url('assets/fundo.avif');"></div>
        <div class="mySlides" style="background-image: url('assets/etec.jpeg');"></div>
        <div class="mySlides" style="background-image: url('assets/relaxante.jpg');"></div>
        <!-- Adicione mais imagens conforme necessário -->
    </div>

    <script src="script.js"></script>
<img class="img" src="assets/ninive.png" alt="Descrição da Imagem">
<div class="content">       
<div class="text-overlay">
        <h2>Bem-vindo ao Nínive, sua<br> ferramenta para organizar,<br> acompanhar e otimizar o acervo<br> de livros, facilitando o acesso e <br>a gestão de recursos educacionais.</h2>
    </div>

</div>   

<h3 class="ferramentas">Ferramentas e recursos</h3>

<div class="container">
<h4 class="caixa"> <img class="imgico" src="assets/livroico.jpg" alt="Descrição da Imagem">Gerenciamento do Acervo<p>Adicione, Altere e delete livros de maneira rapida e simples</p></h4>
    

<h4 class="caixa"> <img class="imgico" src="assets/livroestrelaico.png" alt="Descrição da Imagem">Controle dos livros<p>Tenha um controle e monitoramento dos livros em uso</p></h4>


<h4 class="caixa"> <img class="imgico" src="assets/lendoico.jpeg" alt="Descrição da Imagem">administração dos alunos<p>Mantenha a gestão dos alunos em relação ao tempo, situação e a utilização dos livros</p></h4>

<h4 class="caixa"> <img class="imgico" src="assets/relatorioico.jpg" alt="Descrição da Imagem">Relatorio e anotações <p>Registre e organize as informações dos livros e dos alunos</p></h4>


<h4 class="caixa"> <img class="imgico" src="assets/interacaoico.jpg" alt="Descrição da Imagem">Interação e atualizações<p>Sempre mantenha contato com seus usuarios, alertando eles com novas atualizações</p></h4>

</div>
<h3>Sobre nós</h3>

<h4 class="caixa2"> <img class="img2" src="assets/quemsomos1.jpg" alt="Descrição da Imagem"> <p>Somos a NextByte, e com o projeto Nínive, estamos revolucionando a gestão de bibliotecas. Nosso objetivo é proporcionar sistemas de gerenciamento simples e práticos, que facilitam a administração e aprimoram a experiência dos usuários.</p>

<h4 class="caixa2"> <img class="img2" src="assets/quemsomos2.jpg" alt="Descrição da Imagem"><p>Nosso compromisso é oferecer soluções tecnológicas que sejam intuitivas e acessíveis, permitindo que bibliotecas de todos os tamanhos possam gerenciar suas coleções com eficiência e sem complicações.</p>
    
<h3> Fale conosco </h3>

<div class="form-container">
       
<form id="contactForm" action="contactForm.php" method="post">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="assunto">Assunto:</label>
                <input type="text" id="assunto" name="assunto" placeholder="Assunto" required>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" placeholder="Sua mensagem" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
    <script src="script/script.js"></script>


</body>

</html>