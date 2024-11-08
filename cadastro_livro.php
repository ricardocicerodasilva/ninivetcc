<?php
include('verifica_login.php');
include('includes/db.php');

// Obter os dados do formulário
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$serie = $_POST['serie'];
$autor = $_POST['autor'];
$datacad = $_POST['datacad'];
$datapubli = $_POST['datapubli'];
$cutter = $_POST['cutter'];
$aquisicao = $_POST['aquisicao'];
$exemplar = $_POST['exemplar']; // Número total de exemplares
$edicao = $_POST['edicao'];
$cdd = $_POST['cdd'];
$volume = $_POST['volume'];
$local = $_POST['local'];
$editor = $_POST['editor'];
$lingua = $_POST['lingua'];
$observacao = $_POST['observacao'];
$caminho_arquivo = 'assets/capas/';

// Processar o upload da foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = $_FILES['foto'];
    $pasta_destino = "assets/capas/";
    if (!is_dir($pasta_destino)) {
        mkdir($pasta_destino, 0777, true);
    }
    $nome_arquivo = uniqid() . "_" . basename($foto['name']);
    $caminho_arquivo = $pasta_destino . $nome_arquivo;
    if (!move_uploaded_file($foto['tmp_name'], $caminho_arquivo)) {
        echo "Erro ao salvar a foto.";
        exit;
    }
}

// Preparar a declaração de inserção
$stmt = $con->prepare("INSERT INTO livro (data_cadastro, cdd, cutter, autor, nome_livro, subtitulo, serie_colecao, edicao, volume, editor, data_publicacao, aquisicao, exemplar, lingua, observacao, local, capa_livro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "Erro na preparação da consulta: " . $con->error;
    exit;
}

// Inicializar uma variável para contar os exemplares cadastrados com sucesso
$sucesso_count = 0;

// Loop para cadastrar cada exemplar
for ($i = 1; $i <= $exemplar; $i++) {
    // Definir o ID do exemplar com base no loop
    $exemplar_id = $i;
    $stmt->bind_param("sssssssssssssssss", $datacad, $cdd, $cutter, $autor, $titulo, $subtitulo, $serie, $edicao, $volume, $editor, $datapubli, $aquisicao, $exemplar_id, $lingua, $observacao, $local, $caminho_arquivo);
    
    // Tentar executar o cadastro
    if ($stmt->execute()) {
        $sucesso_count++;
    } else {
        echo "Erro ao cadastrar o exemplar $i: " . $stmt->error . "<br>";
    }
}

// Verificar se todos os exemplares foram cadastrados com sucesso
if ($sucesso_count == $exemplar) {
    echo "Todos os $exemplar exemplares foram cadastrados com sucesso!";
} else {
    echo "Nenhum exemplar foi cadastrado. Verifique os erros acima.";
}

// Fechar a declaração e a conexão
$stmt->close();
$con->close();
?>
