<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Aluno</title>
    <style>
        /* Seu CSS */
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
            font-weight: bold;
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
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            max-width: 800px;
            margin: auto;
            width: 60%;
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

        .form-group input, 
        .form-group textarea {
            padding: 10px;
            font-size: 1rem;
            border: 2px solid #cccccc;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            justify-content: center;
            padding: 12px 20px;
            border: none;
            margin: 0 auto;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            position: relative;
            display: flex;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .hidden {
            display: none;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .activities {
            margin-top: 20px;
            text-align: center;
        }

        .activities a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .activities a:hover {
            background-color: #0056b3;
        }

        .activities h3 {
            margin-bottom: 10px;
            color: #333333;
        }
    </style>
</head>
<body>
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">

    <h2>Buscar Aluno</h2>

    <form id="aluno-form" action="buscar_aluno.php" method="post" class="formulario">
        <div class="form-group">
            <label for="rm">Rm Aluno:</label>
            <input type="text" id="rm" name="rm" required oninput="fetchBookDetails()">
        </div>

        <!-- Outros campos inicialmente ocultos -->
        <div id="aluno-details" class="hidden">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone">
            </div>

            <div class="form-group">
                <label for="periodo">Período:</label>
                <input type="text" id="periodo" name="periodo">
            </div>

        </div>

        <div class="button-container">
            <input type="submit" value="Buscar">
        </div>
    </form>

    <script>
        function fetchBookDetails() {
            const codeInput = document.getElementById('codigo').value;
            const detailsContainer = document.getElementById('book-details');

            if (codeInput.length > 0) {
                fetch(`buscar_livro.php?codigo=${encodeURIComponent(codeInput)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            detailsContainer.classList.add('hidden');
                            alert(data.error);
                        } else {
                            document.getElementById('titulo').value = data.titulo || '';
                            document.getElementById('autor').value = data.autor || '';
                            document.getElementById('editora').value = data.editora || '';
                            document.getElementById('datapubli').value = data.datapubli || '';
                            document.getElementById('edicao').value = data.edicao || '';
                            document.getElementById('genero').value = data.genero || '';
                            document.getElementById('unidades').value = data.unidades || '';
                            document.getElementById('sinopse').value = data.sinopse || '';

                            detailsContainer.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar livro:', error);
                    });
            } else {
                detailsContainer.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
