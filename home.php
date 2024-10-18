<?php   
session_start(['cookie_lifetime' => 60]);

if (!isset($_SESSION['iniciado'])) {
    $_SESSION['iniciado'] = time(); // Marca o início da sessão
}

if (time() - $_SESSION['iniciado'] > 60) { // Verifica se passou 60 segundos
    session_destroy(); // Destrói a sessão
    header('Location: logout.php'); // Redireciona para a página de logout, se necessário
    exit();
}

include('./verifica_login.php');
require_once 'home.php';

// Verifica se a conexão está ativa
if (!$con || mysqli_connect_errno()) {
    die("Falha na conexão com o banco de dados.");
}

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: home.php'); // redireciona para a página de login
    exit();
}

// Pega o ID do usuário logado da sessão
$id = $_SESSION['id_usuario'];

// Consulta usando prepared statements para maior segurança
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se a consulta retornou resultados
if ($result && mysqli_num_rows($result) > 0) {
    $dados = mysqli_fetch_array($result);
    // Exibe o nome do usuário
   // echo "Bem-vindo, " . htmlspecialchars($dados['nome']) . "!";
} else {
    echo "Usuário não encontrado.";
}

// Fecha a conexão com o banco de dados
mysqli_stmt_close($stmt);
mysqli_close($con);
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
<h2 class="login-usuario"><?php echo $dados['login']; ?></h2>
<div class="container-botao">
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
                <a href="#">Gerenciar livros</a>
                <ul class="submenu">
                    <li><a href="cadastrar.php">Cadastrar </a></li><br>
                    <li><a href="atualizar.php">Atualizar</a></li><br>
                    <li><a href="buscar.php">Buscar</a></li><br>
                    <li><a href="deletar.php">Arquivar</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Gerenciar alunos</a>
                <ul class="submenu">
                    <li><a href="cadastrar_aluno.php">Cadastrar</a></li><br>
                    <li><a href="atualizar_aluno.php">Atualizar</a></li><br>
                    <li><a href="buscar_aluno.php">Buscar</a></li><br>
                    <li><a href="bloquear_aluno.php">Bloquear</a></li><br>
                </ul>
            </li>
            <li>
                <a href="#">Acervo</a>
                <ul class="submenu">
                    <li><a href="listar_acervo.php">Listar</a></li><br>
                    <li><a href="reserva.php">Reservar</a></li><br>
                </ul>
            </li>
            <li>
                <a href="#">Notificações</a>
                <ul class="submenu">
                    <li><a href="notificacoes.php">Visualizar notificações</a></li>
                   
                </ul>
            </li>
            <li>
                <a href="#">Relatório</a>
                <ul class="submenu">
                    <li><a href="gerar_relatorio.php">Gerar relatório</a></li><br>
                    <li><a href="listar_relatorio.php">Visualizar relatórios</a></li><br>
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
       
<form id="contactForm" action="contactForm" method="post">

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" placeholder="Seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="message">Mensagem:</label>
                <textarea id="message" name="message" placeholder="Sua mensagem" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>
    <script src="script/script.js"></script>
  

</body>

</html>