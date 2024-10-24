<?php
session_start();
include('./verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloquear Aluno </title>
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
    align-items: center;
    left:180px;
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
    background-color: #4CAF50;
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
    left:180px;
    
}
.button-container {
    display: flex;
    justify-content: center;
    margin: 0 auto; /* Centraliza horizontalmente */
    align-items: center;
  
}

        input[type="submit"]:hover {
            background-color: #45a049;
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

<form method="post">
    <label for="rm_aluno">RM do aluno(a):</label>
    <input type="number" name="rm_aluno" id="rm_aluno" required>
    <input type="submit" name="buscar" value="Buscar">
</form>

<?php
if (isset($_POST['buscar'])) {
    $rm_aluno = $_POST['rm_aluno'];

    // Consultar o aluno
    $sql = "SELECT * FROM aluno WHERE rm_aluno = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $rm_aluno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
?>
       <form action="bloqueio_aluno.php" method="post">
    <h2>Detalhes do aluno</h2>
    <table>
        <tr>
            <th>RM do aluno(a)</th>
            <td><?php echo htmlspecialchars($aluno['rm_aluno']); ?></td>
        </tr>
        <tr>
            <th>Nome do aluno(a)</th>
            <td><?php echo htmlspecialchars($aluno['nome_aluno']); ?></td>
        </tr>
        <tr>
            <th>Bloqueado</th>
            <td><?php echo isset($aluno["bloqueado"]) && $aluno["bloqueado"] == 1 ? "Sim" : "Não"; ?></td>
        </tr>
    </table>
    <?php
    $bloqueado = $aluno['bloqueado'] ?? null; // Coalescência nula para evitar avisos

    if ($bloqueado == 1) {
        echo "<input type='hidden' name='motivo_bloq' id='motivo_bloq' value='null'>";
    } else {
        echo "Motivo do bloqueio:</p>";
        echo "<textarea name='motivo_bloq' id='motivo_bloq' cols='30' rows='10' style='resize: none;' required></textarea></p>";
    }
    ?>
    <input type="hidden" name="rm_aluno" value="<?php echo htmlspecialchars($aluno['rm_aluno']); ?>">
    <input type="hidden" name="bloqueado" value="<?php echo htmlspecialchars($bloqueado); ?>">

    <input type="submit" name="bloquear" value="<?php echo $bloqueado == 1 ? 'Desbloquear' : 'Bloquear'; ?>">
</form>

<?php
    } else {
        echo "Aluno não encontrado.";
    }

    $stmt->close();
    $con->close();
}
?>

<center>
    <h3><a href='home.php'>Voltar para a página inicial</a></h3>
</center>
</body>
</html>
