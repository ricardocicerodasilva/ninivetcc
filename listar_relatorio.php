<?php
include('verifica_login.php');
include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Relatórios</title>
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

        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 40px;
        }

        .formulario {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .relatorios {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .relatorio-item {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .relatorio-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .relatorio-item a:hover {
            text-decoration: underline;
        }

        .apagar-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .apagar-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <a href="home.php">
        <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
    </a>

    <form  method="post" class="formulario">
        <div class="form-group">
            <label for="relatorio">Relatórios:</label>
            <ul class="relatorios">
                <?php
                $dir = 'relatorios/';
                if (is_dir($dir)) {
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        if ($file !== '.' && $file !== '..') {
                            echo '<li class="relatorio-item">
                                    <a href="' . $dir . $file . '" target="_blank">' . $file . '</a>
                                    <form action="apagar_relatorio.php" method="post" style="display:inline;">
                                        <input type="hidden" name="file" value="' . $file . '">
                                        <button type="submit" class="apagar-btn" onclick="return confirm(\'Tem certeza que deseja apagar este relatório?\')">Apagar</button>
                                    </form>
                                  </li>';
                        }
                    }
                } else {
                    echo "<li>Nenhum relatório encontrado.</li>";
                }
                ?>
            </ul>
        </div>
    </form>
    <?php
$dir = 'relatorios/';

if (isset($_POST['file'])) {
    $file = basename($_POST['file']); // Obter o nome do arquivo
    $filePath = $dir . $file;

    // Verifica se o arquivo existe
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "Relatório apagado com sucesso.";
        } else {
            echo "Erro ao apagar o relatório.";
        }
    } else {
        echo "Relatório não encontrado.";
    }
}

// Redireciona de volta para a lista de relatórios
//header("Location: listar_relatorios.php");
exit;
?>
</body>
</html>