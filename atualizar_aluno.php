<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Aluno </title>
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
            background-image: url('assets/imgcadastro.jpg');
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
  /*/  width: 50%;*/
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
    left:200px;
    
}
input[type="submit"]:hover {
            background-color: #676767;
        }
.button-container {
    display: flex;
    justify-content: center;
    margin: 0 auto; /* Centraliza horizontalmente */
    align-items: center;
    
  
}
button{
    background-color: #0a6789;
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
    right:10px;
        }
        button[type="button"]:hover {
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


    <h2>Atualizar Aluno</h2>

    
<form id="aluno-form" class="formulario" onsubmit="atualizarAluno(); return false;">
    <div class="form-group">
        <label for="rm">RM Aluno:</label>
        <input type="text" id="rm" name="rm" required>
        <button type="button" onclick="buscarAluno()">Buscar</button>
    </div><br>

    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
    </div>
    
    <div class="form-group">
        <label for="turma">Turma:</label>
        <input type="text" id="turma" name="turma" required>
    </div>

    <div class="form-group">
        <label for="periodo">Período:</label>
        <input type="text" id="periodo" name="periodo" required>
    </div>

    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>

    <div class="button-container">
        <input type="submit" value="Atualizar">
    </div>
</form>

<script>
function buscarAluno() {
    var rm = document.getElementById("rm").value;
    if (rm) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "busca_aluno.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        if (data) {
                            document.getElementById("nome").value = data.nome_aluno;
                            document.getElementById("email").value = data.email;
                            document.getElementById("telefone").value = data.telefone;
                            document.getElementById("turma").value = data.turma;
                            document.getElementById("periodo").value = data.periodo;
                            document.getElementById("senha").value = data.senha;
                        } else {
                            alert("Aluno não encontrado.");
                        }
                    } catch (e) {
                        alert("Erro ao processar os dados: " + e.message);
                    }
                } else {
                    alert("Erro na requisição: " + xhr.status);
                }
            }
        };
        xhr.send("rm=" + encodeURIComponent(rm));
    } else {
        alert("Por favor, insira um RM.");
    }
}

function atualizarAluno() {
    const formData = new FormData(document.getElementById('aluno-form'));

    fetch('atualiza_aluno.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.status === 'success') {
            document.getElementById('aluno-form').reset(); // Limpa o formulário se a atualização for bem-sucedida
        }
    })
    .catch(error => {
        console.error('Erro na atualização:', error);
        alert('Erro ao processar a solicitação.');
    });
}
</script>

</body>
</html>