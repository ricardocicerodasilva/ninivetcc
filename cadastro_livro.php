
<?php


include('verifica_login.php');

$host = "localhost:3306";
$user = "root";
$pass = "";
$base = "etecguaru01";

// Conexão com o banco de dados
$con = mysqli_connect($host, $user, $pass, $base);

// Obtenha os dados do formulário

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
$local = (int)$_POST['local']; // Converta para inteiro
$editor = $_POST['editor'];
$lingua = $_POST['lingua'];
$observacao = $_POST['observacao'];


// Usar prepared statements para evitar SQL injection
$stmt = $con->prepare("INSERT INTO livro (data_cadastro, cdd, cutter, autor, nome_livro, subtitulo, série_colecao, edicao,volume,editor,data_publicacao,aquisicao,exemplar,lingua,observacao,local,capa_livro) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?)");

for ($i = 0; $i < $unidade; $i++) {
    $stmt->bind_param("sssssssssssssssss", $datacad, $cdd, $cutter, $autor, $titulo, $subtitulo, $serie, $edicao,$volume,$editor,$datapubli,$aquisicao,$exemplar,$lingua,$observacao,$local,$capa_livro);
    
    if ($stmt->execute()) {
        $last_id = $stmt->insert_id; 
        echo "Cadastro realizado com sucesso! ID gerado: " . $last_id . "<br>";
    } else {
        echo "Erro ao cadastrar o Livro: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$con->close();
?>
