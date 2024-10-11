<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Título da Página</title>
    <style>
        body {
            background-image: url('ninive.png');
            background-size: 50%; /* Diminui a imagem de fundo */
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: #818274;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          
           
        }

        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;  
            margin-right: 80px
        }

        input[type="submit"] {
            width: 50%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            align-items: center;
            justify-content: center;
             display: block;
             margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <label for="nome">Informe usuário:</label>
        <input type="text" id="nome" name="nome"><br>
        <label for="senha">Informe senha:</label>
        <input type="password" id="senha" name="senha"><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
