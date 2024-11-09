<?php
include('verifica_login.php');
include('includes/db.php');

$msg = false;
$login = $_SESSION['login'];

// Verificar e fazer o upload da nova imagem de perfil
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
    // Verificar a extensão do arquivo para aceitar apenas formatos de imagem
    $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
    $extensoesPermitidas = ['jpg', 'jpeg', 'png'];
    
    if (in_array($extensao, $extensoesPermitidas)) {
        // Gerar um novo nome único para o arquivo
        $novoNomeArquivo = md5(time() . $_FILES['arquivo']['name']) . '.' . $extensao;
        $diretorio = "assets/perfil/";

        // Verificar se a pasta tem permissões para escrita
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novoNomeArquivo)) {
            // Atualizar o caminho da imagem no banco de dados
            $sqlInsertQuery = "UPDATE bibliotecario SET foto_perfil = '$diretorio$novoNomeArquivo' WHERE login = '$login'";
            
            if (mysqli_query($con, $sqlInsertQuery)) {
                $msg = "Foto de perfil alterada com sucesso!";
            } else {
                $msg = "Erro ao atualizar a foto de perfil no banco: " . mysqli_error($con);
            }
        } else {
            $msg = "Erro ao mover o arquivo para o diretório.";
        }
    } else {
        $msg = "Formato de arquivo não permitido. Por favor, envie uma imagem JPEG ou PNG.";
    }
} elseif (isset($_FILES['arquivo'])) {
    $msg = "Erro no upload do arquivo: " . $_FILES['arquivo']['error'];
}

// Buscar imagem de perfil atual do usuário logado
$sqlSelectQuery = "SELECT foto_perfil FROM bibliotecario WHERE login = '$login'";
$result = mysqli_query($con, $sqlSelectQuery);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $foto_perfil = $userData['foto_perfil'] ?: 'assets/default.jpg'; // Define uma imagem padrão se não houver foto
} else {
    $msg = "Erro ao buscar a imagem de perfil: " . mysqli_error($con);
    $foto_perfil = 'assets/default.jpg';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Configurar Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('assets/imgcadastro.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: auto;
        }
        .image {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
            z-index: 1000;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f3f3f3;
            padding: 70px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 80px auto;
        }
        .container h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .container h3 {
            font-size: 16px;
            color: #555;
            margin-top: 15px;
        }
        .container img {
            border-radius: 50%;
            border: 2px solid #ddd;
            margin: 10px 0;
        }
        .file {
            margin-top: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #0a6789;
            width: 30%;
            color: white;
            padding: 12px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #676767;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<center>
    <h2><?php if ($msg) echo "<p>$msg</p>"; ?></h2>
    <form method="POST" action="alterar_perfil.php" enctype="multipart/form-data">
    <div class="container">
        <div>
            <h1>Alterar Imagem</h1>
            <h3>Imagem Atual</h3>
            <!-- Exibe a imagem atual com um parâmetro para evitar cache -->
            <img src="<?php echo $foto_perfil . '?v=' . time(); ?>" width="100px" height="100px" alt="Imagem de Perfil">
            <h3>Envie a Imagem Nova</h3>
<input type="file" name="arquivo" accept=".jpg, .jpeg, .png" class="file">

        </div>
        <input type="submit" class="button" value="Atualizar" />
    </div>
    </form>
</center>
</body>
</html>
