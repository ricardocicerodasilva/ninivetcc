<?php 
include('verifica_login.php');
include('includes/db.php');

// Verifica se o título do livro foi enviado
if (isset($_POST['titulo']) && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];  // ID ou código do livro a ser atualizado
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $serie = $_POST['serie'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $datacad = $_POST['datacad'];
    $datapubli = $_POST['datapubli'];
    $cutter = $_POST['cutter'];
    $aquisicao = $_POST['aquisicao'];
    $exemplar = $_POST['exemplar'];
    $edicao = $_POST['edicao'];
    $cdd = $_POST['cdd'];
    $volume = $_POST['volume'];
    $local = $_POST['local'];
    $editor = $_POST['editor'];
    $lingua = $_POST['lingua'];
    $observacao = $_POST['observacao'];
    $caminho_arquivo = null;

    // Verificar se uma nova foto foi enviada
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

    // Montar query de atualização com ou sem imagem
    if ($caminho_arquivo) {
        $stmt = $con->prepare("UPDATE LIVRO SET data_cadastro = ?, cdd = ?, cutter = ?, autor = ?, nome_livro = ?, subtitulo = ?, série_colecao = ?, edicao = ?, volume = ?, editor = ?, data_publicacao = ?, aquisicao = ?, exemplar = ?, lingua = ?, observacao = ?, local = ?, capa_livro = ? WHERE codigo = ?");
        $stmt->bind_param("sssssssssssssssssi", $datacad, $cdd, $cutter, $autor, $titulo, $subtitulo, $serie, $edicao, $volume, $editor, $datapubli, $aquisicao, $exemplar, $lingua, $observacao, $local, $caminho_arquivo, $codigo);
    } else {
        $stmt = $con->prepare("UPDATE LIVRO SET data_cadastro = ?, cdd = ?, cutter = ?, autor = ?, nome_livro = ?, subtitulo = ?, série_colecao = ?, edicao = ?, volume = ?, editor = ?, data_publicacao = ?, aquisicao = ?, exemplar = ?, lingua = ?, observacao = ?, local = ? WHERE codigo = ?");
        $stmt->bind_param("ssssssssssssssssi", $datacad, $cdd, $cutter, $autor, $titulo, $subtitulo, $serie, $edicao, $volume, $editor, $datapubli, $aquisicao, $exemplar, $lingua, $observacao, $local, $codigo);
    }

    if ($stmt->execute()) {
        echo "Livro atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o Livro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro: dados insuficientes para atualizar o livro.";
}

$con->close();
?>
