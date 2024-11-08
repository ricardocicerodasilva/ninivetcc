<?php

include('verifica_login.php');


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livro </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('assets/imgcadastro.jpg');
            background-repeat: no-repeat;
          /*  background-attachment: fixed;*/
            background-size: cover; /* Ajusta a largura para 100% e a altura para 50% */
            height:auto;
           /* background-position: center top 60px; /* Ajuste a posição da imagem de fundo */
        }

        .image {
            position: absolute; /* Fixa a imagem na tela */
            top: 10px; /* Ajuste a posição vertical conforme necessário */
            left: 20px; /* Ajuste a posição horizontal conforme necessário */
            width: 100px; /* Ajuste o tamanho conforme necessário */
            height: auto; /* Mantém a proporção da imagem */
            z-index: 1000; /* Garante que a imagem esteja acima de outros elementos */
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            color: bold;
            font-size: 40px;        }

        form {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            background-image: url('imgcadastro.jpg');
            background-repeat: no-repeat;
          /*  background-attachment: fixed;*/
            background-size: auto; /* Ajusta a largura para 100% e a altura para 50% */
            height:auto;
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
            background-image: url('assets/imgcadastro.jpg');
            background-repeat: no-repeat;
          /*  background-attachment: fixed;*/
            background-size: auto; /* Ajusta a largura para 100% e a altura para 50% */
            height:auto;
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
    padding: 45px;
    font-size: 1rem;
    border: 4px solid blackgray color;
    border-radius: 4px;
}

.form-group textarea {
    resize: vertical;
}

/* input[type="submit"] {
    grid-column: span 2;
    padding: 10px;
    font-size: 1rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
} */

input[type="submit"]:hover {
    background-color: #45a049;
}

    input[type="text"],
        input[type="text"],
        input[type="text"],
        input[type="date"],
        input[type="text"],
        input[type="text"],
        input[type="text"],
        input[type="text"],
        
        textarea {
            width: 100%;
            padding: 20px;
            margin-bottom: 15px;
            border: 4px solid #cccccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
    background-color: #0a6789;
  /* width: 50%;*/
    color: white;
    justify-content:center;
    padding: 12px 20px;
    border: none;
   margin: 0 auto; /* Centraliza horizontalmente */
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
    position: relative;
    display: flex;
    right:200px;
    
}
.button-container {
    display: flex;
    justify-content: center;
    margin: 0 auto; /* Centraliza horizontalmente */
    align-items: center;
    
  
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
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>


    <h2>Cadastro de Livro</h2>
 

<script>
    function cadastrarLivro(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        fetch('cadastro_livro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("sucesso")) {
                alert("Livro cadastrado com sucesso!");
                event.target.reset();
            } else {
                alert("Erro ao cadastrar o livro: " + data);
            }
        })
        .catch(error => console.error('Erro:', error));
    }
</script>

<form onsubmit="cadastrarLivro(event)" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titulo">Título do Livro:</label>
        <input type="text" id="titulo" name="titulo" required>
    </div>
    <div class="form-group">
        <label for="subtitulo">Subtítulo do Livro:</label>
        <input type="text" id="subtitulo" name="subtitulo" required>
    </div>
    <div class="form-group">
        <label for="serie">Série/coleção:</label>
        <input type="text" id="serie" name="serie" required>
    </div>
    <div class="form-group">
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required>
    </div>
    <div class="form-group">
        <label for="datacad">Data Cadastro:</label>
        <input type="date" id="datacad" name="datacad" required>
    </div>
    <div class="form-group">
        <label for="datapubli">Data de Publicação:</label>
        <input type="date" id="datapubli" name="datapubli" required>
    </div>
    <div class="form-group">
        <label for="cutter">Cutter:</label>
        <input type="text" id="cutter" name="cutter" required>
    </div>
    <div class="form-group">
        <label for="aquisicao">Aquisição:</label>
        <input type="text" id="aquisicao" name="aquisicao" required>
    </div>
    <div class="form-group">
        <label for="exemplar">Exemplar:</label>
        <input type="number" id="exemplar" name="exemplar" required>
    </div>
    <div class="form-group">
        <label for="edicao">Edição:</label>
        <input type="text" id="edicao" name="edicao" required>
    </div>
    <div class="form-group">
        <label for="cdd">Cdd:</label>
        <input type="number" id="cdd" name="cdd" required>
    </div>
    <div class="form-group">
        <label for="volume">Volume:</label>
        <input type="text" id="volume" name="volume" required>
    </div>
    <div class="form-group">
        <label for="local">Local:</label>
        <input type="text" id="local" name="local" required>
    </div>
    <div class="form-group">
        <label for="editor">Editor:</label>
        <input type="text" id="editor" name="editor" required>
    </div>
    <div class="form-group">
        <label for="lingua">Língua:</label>
        <input type="text" id="lingua" name="lingua" required>
    </div>
    <div class="form-group">
        <label for="observacao">Observação:</label>
        <textarea id="observacao" name="observacao" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="foto">Foto do livro:</label>
        <input type="file" id="foto" name="foto" accept="image/*">
    </div>
    <div class="button-container">
        <input type="submit" value="Cadastrar">
    </div>
</form>

</body>
</html>
