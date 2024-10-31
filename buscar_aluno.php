<?php
include('verifica_login.php');
?>
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
            width: 100px;1
            height: auto;
            z-index: 1000;
        }

        h2 {
            text-align: center;
            margin-top: 40px;
            font-weight: bold;
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
            justify-content: center;
            /*flex-direction: column;*/
            position:absolute;
            margin: 0 auto ;
            display: flex;
            left:500px
        }

       .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            margin-top:15px
           
          
            
        }

        .form-group input, 
        .form-group textarea {
            padding: 10px;
            font-size: 1rem;
            border: 2px solid #cccccc;
            border-radius: 4px;
            
        }

       input[type="submit"] {
            background-color: #0a6789;
            color: white;
            justify-content: center;
            padding: 12px 20px;
            border: none;
            margin: 0 auto;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            display: flex;
            margin-top:40px;
        }

        input[type="submit"]:hover {
            background-color:#676767;
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

        /* Estilo da tabela */
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        th, td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: white;
            color: black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<h2>Buscar Aluno</h2>

<form  method="post" >
    <div class="form-group">
        <label for="rm">RM Aluno:</label>
        <input type="text" id="rm" name="rm" required oninput="fetchAlunoDetails()">
    </div>
    <br>
    <div class="button-container">
        <input type="submit" name="buscar" value="Buscar">
    </div>
</form>

<?php
    if (isset($_POST['buscar'])) {
        $rm = $_POST['rm'];

        // Consultar o livro
        $sql = "SELECT * FROM aluno WHERE rm_aluno = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $rm);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rm = $result->fetch_assoc();
    ?>
            <h2>Detalhes do Aluno</h2>
            <table>
                <tr>
                    <th>Rm</th>
                    <td><?php echo $rm['rm_aluno']; ?></td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td><?php echo $rm['nome_aluno']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $rm['email']; ?></td>
                </tr>
                <tr>
                    <th>Gênero</th>
                    <td><?php echo $rm['telefone']; ?></td>
                </tr>
                <tr>
                    <th>Turma</th>
                    <td><?php echo $rm['turma']; ?></td>
                </tr>
                <tr>
                    <th>Periodo</th>
                    <td><?php echo $rm['periodo']; ?></td>
                </tr>
                
                <tr>
                    <th>Bloqueado</th>
                    <td><?php if ($rm["bloqueado"] == 1) {
                            echo "Sim";
                        } else {
                            echo "Não";
                        } ?></td>
                </tr>
                <tr>
                    <th>Motivo Bloqueio</th>
                    <td><?php echo $rm['motivo_bloq']; ?></td>
                </tr>
                
               
                <tr>
                    <th>Foto</th>
                    <td><?php echo $rm['foto_perfil']; ?></td>
                </tr>
               
            </table>
    <?php
        } else {
            echo "aluno não encontrado.";
        }

        $stmt->close();
        $con->close();
    }
    ?>

<script>
function fetchAlunoDetails() {
    const rmInput = document.getElementById('rm').value;
    const alunoDetailsContainer = document.getElementById('tabela-aluno');

    if (rmInput.length > 0) {
        fetch(`busca_aluno.php?rm=${encodeURIComponent(rmInput)}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alunoDetailsContainer.classList.add('hidden');
                    alert(data.error);
                } else {
                    document.getElementById('nome').textContent = data.nome_aluno || '';
                    document.getElementById('email').textContent = data.email || '';
                    document.getElementById('telefone').textContent = data.telefone || '';
                    document.getElementById('periodo').textContent = data.periodo || '';
                    alunoDetailsContainer.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Erro ao buscar aluno:', error);
            });
    } else {
        alunoDetailsContainer.classList.add('hidden');
    }
}
</script>

</body>
</html>
