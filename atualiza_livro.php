<?php



include('verifica_login.php');


$host = "localhost";
$user = "root";
$pass = "";
$base = "etecguaru01";

$con = mysqli_connect($host, $user, $pass, $base);

// Verifica se o código do livro foi enviado
if (isset($_POST['titulo'])) {
    //$codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $serie = $_POST['serie$serie'];
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
    $foto = $_POST['foto'];
    $cdd = $_POST['cdd'];
    
    // Usar prepared statements para evitar SQL injection
    $stmt = $con->prepare("UPDATE LIVRO SET data_cadastro = ?, cdd= ?, cutter= ?, autor= ?, nome_livro = ?, subtitulo = ?, série_colecao = ?, edicao = ?,volume = ?,editor = ?,data_publicacao = ?,aquisicao = ?,exemplar = ?,lingua = ?,observacao = ?,local = ?,capa_livro = ? ");
    $stmt->bind_param("ssssssssssssssssss", $datacad, $cdd, $cutter, $autor, $titulo, $subtitulo, $serie, $edicao,$volume,$editor,$datapubli,$aquisicao,$exemplar,$lingua,$observacao,$local,$foto );

    if ($stmt->execute()) {
        echo "Livro atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o Livro: " . $stmt->error;
    }

    $stmt->close();
}
$con->close();
?>
