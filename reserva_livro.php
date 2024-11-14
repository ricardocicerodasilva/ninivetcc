<?php
include('verifica_login.php');  // Verifica o login do usuário
include('includes/db.php');      // Conecta ao banco de dados
$id_bibli = $_SESSION['login'];
$num_reserva = $_SESSION['login'];

if (isset($_POST['btn-reservar'])) {
    $nomeLivro = mysqli_escape_string($con, $_POST['nomeLivro']);
    $rmAluno = mysqli_escape_string($con, $_POST['rmAluno']);
    $dataReserva = mysqli_escape_string($con, $_POST['dataReserva']);
    $dataDevolucao = mysqli_escape_string($con, $_POST['dataDevolucao']);

    if (empty($nomeLivro) || empty($rmAluno) || empty($dataReserva) || empty($dataDevolucao)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        $sqlLivro = "SELECT id_livro FROM livro WHERE nome_livro = '$nomeLivro'";
        $resultLivro = mysqli_query($con, $sqlLivro);

        if ($resultLivro && mysqli_num_rows($resultLivro) > 0) {
            $rowLivro = mysqli_fetch_assoc($resultLivro);
            $idLivro = $rowLivro['id_livro'];

            $sqlAluno = "SELECT rm_aluno FROM aluno WHERE rm_aluno = '$rmAluno'";
            $resultAluno = mysqli_query($con, $sqlAluno);

            if ($resultAluno && mysqli_num_rows($resultAluno) > 0) {
                $sqlReserva = "INSERT INTO reserva (id_livro, rm_aluno, data_reserva, data_devolucao)
                               VALUES ('$idLivro', '$rmAluno', '$dataReserva', '$dataDevolucao')";
                
                if (mysqli_query($con, $sqlReserva)) {
                    echo "Reserva realizada com sucesso!";
                    }
                 else {
                    echo "Erro ao realizar a reserva.";
                }
            } else {
                echo "Aluno não encontrado!";
            }
        } else {
            echo "Livro não encontrado!";
        }
    }
} else {
    echo "Formulário não enviado corretamente!";
}
?>
