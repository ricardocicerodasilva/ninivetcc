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

        form {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .formulario {
            display: grid;
            gap: 20px;
            max-width: 800px;
            margin: auto;
        }

        .notifications {
            list-style: none;
            padding: 0;
        }

        .notification-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

    <h2>Notificações</h2>

    <form action="notificacoes.php" method="post" class="formulario">
        <div class="form-group">
           
            <ul class="notifications" id="notifications">
                <li class="notification-item">
                    <input type="checkbox" id="notif1" name="notifications[]" value="notif1">
                    <label for="notif1">Notificação 1</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif2" name="notifications[]" value="notif2">
                    <label for="notif2">Notificação 2</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif3" name="notifications[]" value="notif3">
                    <label for="notif3">Notificação 3</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif4" name="notifications[]" value="notif4">
                    <label for="notif3">Notificação 4</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif5" name="notifications[]" value="notif5">
                    <label for="notif3">Notificação 5</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif6" name="notifications[]" value="notif6">
                    <label for="notif7">Notificação 6</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif7" name="notifications[]" value="notif7">
                    <label for="notif7">Notificação 7</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif8" name="notifications[]" value="notif8">
                    <label for="notif8">Notificação 8</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif9" name="notifications[]" value="notif9">
                    <label for="notif9">Notificação 9</label>
                </li>
                <li class="notification-item">
                    <input type="checkbox" id="notif10" name="notifications[]" value="notif10">
                    <label for="notif10">Notificação 10</label>
                </li>
            </ul>
        </div>
        
        <input type="submit" value="Deletar Notificações">
    </form>
</body>
</html>
