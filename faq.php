<?php

include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    
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

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 36px;
        }

        .faq-item {
            margin: 20px 0;
        }

        .faq-question {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            cursor: pointer;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .faq-question:hover {
            background-color: #e1e1e1;
        }

        .faq-answer {
            display: none;
            padding: 10px;
            margin-top: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            border-radius: 5px;
            color: #333;
        }

        .faq-answer p {
            margin: 0;
        }
        .image {
            position: absolute; /* Fixa a imagem na tela */
            top: 10px; /* Ajuste a posição vertical conforme necessário */
            left: 20px; /* Ajuste a posição horizontal conforme necessário */
            width: 100px; /* Ajuste o tamanho conforme necessário */
            height: auto; /* Mantém a proporção da imagem */
            z-index: 1000; /* Garante que a imagem esteja acima de outros elementos */
        }

    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>


    <div class="container">
        <h2>Perguntas Frequentes</h2>

        <div class="faq-item">
            <div class="faq-question">Como cadastrar um livro ou aluno?</div>
            <div class="faq-answer">
                <p>Para cadastrar um livro ou aluno, vá ao menu principal, selecione a opção "Cadastrar", insira os dados necessários e clique em "Salvar".</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Como atualizar as informações de um livro ou aluno?</div>
            <div class="faq-answer">
                <p>Para atualizar as informações, acesse o menu "Atualizar", procure pelo registro desejado, faça as alterações e clique em "Atualizar".</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Como posso deletar ou arquivar registros?</div>
            <div class="faq-answer">
                <p>Você pode arquivar ou deletar registros acessando a seção "Deletar". Selecione o item a ser removido e confirme a ação.</p>
            </div>
        </div>

    </div>

    <script>
        // Pega todas as perguntas de FAQ
        const questions = document.querySelectorAll('.faq-question');

        questions.forEach((question) => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;

                // Alterna a exibição da resposta
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>

</body>
</html>
