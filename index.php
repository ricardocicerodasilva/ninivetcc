


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <style>
        body {
            background-image: url('assets/ninive.png');
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
            background-color: #D2DCE5;
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

        .button {
    width: 30%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 0 auto;
}

.button:hover {
    background-color: #45a049;
}


        label {
            font-weight: 800;
        }
    </style>


</head>
<body>
<form action="login.php" method="POST">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login"><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha"><br>

    <button type="submit" name="btn-entrar" class="button">Entrar</button>

</form>

 
</body>
</html>
