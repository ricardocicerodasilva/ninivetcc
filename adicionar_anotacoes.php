<?php

include('verifica_login.php');
include('includes/db.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anotações</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('assets/imgcadastro.jpg');
            background-size: cover;
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
            color: #333;
        }

        form {
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
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            width: 60%;
            margin-top:20px;
           
        }

        .form-group input{
            width: 20%;
            padding: 15px;
            font-size: 1rem;
            border: 2px solid #cccccc;
            border-radius: 6px;
            box-sizing: border-box;
            position: absolute;
            left:365px

        }
        .form-group textarea {
            width: 80%;
            padding: 60px;
            font-size: 1rem;
            border: 2px solid #cccccc;
            border-radius: 6px;
            box-sizing: border-box;
            display: flex;
            margin:0 auto
            
        }

        .form-group textarea {
            resize: vertical;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #0a6789;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            margin-top:25px
        }

        input[type="submit"]:hover {
            background-color: #676767;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<h2>Anotações</h2>

<script>
        function anotacoes(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            
            fetch('adicionar_anotacoes.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(" cadastrado com sucesso");
                event.target.reset();
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>

<form onsubmit="anotacoes(event)">

    <div class="form-group">
        <label for="sinopse"></label>
        <textarea id="sinopse" name="sinopse" required></textarea>
    </div>
    <div class="form-group">
        <label for="data"></label>
        <input type="date" id="data" name="data" required/>
    </div>

    <div class="button-container">
        <input type="submit" value="Cadastrar">
    </div>
</form>
</body>
</html>


<?php

// Executa a inserção somente se o formulário tiver sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $sinopse = $_POST['sinopse'];
    $data = $_POST['data'];

    // Usar prepared statements para evitar SQL injection
    $stmt = $con->prepare("INSERT INTO anotacao (anotacao, data_anotacao) VALUES (?, ?)");
    $stmt->bind_param("ss", $sinopse, $data);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}
$con->close();
?>
