<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Acervo</title>
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

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .relatorios {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .relatorio-item {
            margin: 10px 0;
        }

        .relatorio-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .relatorio-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">

    <h2>Listar Relatórios</h2>

    <form action="listar_acervo.php" method="post" class="formulario">
        <div class="form-group">
            <label for="relatorio">Relatórios:</label>
            <ul class="relatorios">
                <li class="relatorio-item">
                    <a href="relatorio1.php" target="_blank">Relatório 1</a>
                </li>
                <li class="relatorio-item">
                    <a href="relatorio2.php" target="_blank">Relatório 2</a>
                </li>
                <li class="relatorio-item">
                    <a href="relatorio3.php" target="_blank">Relatório 3</a>
                </li>
                <!-- Adicione mais relatórios conforme necessário -->
            </ul>
        </div>
    </form>
</body>
</html>
