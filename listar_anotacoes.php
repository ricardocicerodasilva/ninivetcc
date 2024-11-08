<?php

include('verifica_login.php');
include('includes/db.php');

// Consulta para obter as anotações
$sql = "SELECT id_anotacao, anotacao, data_anotacao FROM anotacao ORDER BY data_anotacao DESC";
$result = mysqli_query($con, $sql);

// Verifica se uma anotação foi solicitada para exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM anotacao WHERE id_anotacao = ?";
    $stmt = $con->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    header("Location: listar_anotacoes.php"); // Atualiza a página após a exclusão
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Anotações</title>
    <style>
        /* (Estilos de página, mantendo o estilo anterior) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('assets/imgcadastro.jpg');
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
        .container {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .anotacao {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #e9e9e9;
            border-radius: 5px;
        }
        .anotacao h4 {
            margin: 0;
            font-weight: bold;
        }
        .anotacao p {
            margin: 5px 0;
            flex-grow: 1;
        }
        .delete-btn {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
<a href="home.php">
    <img class="image" src="assets/ninive.png" alt="Descrição da Imagem">
</a>

<h2>Anotações</h2>
<div class="container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="anotacao">
                <div>
                    <h4>Data: <?php echo date("d/m/Y", strtotime($row['data_anotacao'])); ?></h4>
                    <p><?php echo htmlspecialchars($row['anotacao']); ?></p>
                </div>
                <form method="post" style="margin: 0;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id_anotacao']; ?>">
                    <button type="submit" class="delete-btn">Apagar</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhuma anotação encontrada.</p>
    <?php endif; ?>
</div>

<?php
mysqli_close($con);
?>
</body>
</html>
